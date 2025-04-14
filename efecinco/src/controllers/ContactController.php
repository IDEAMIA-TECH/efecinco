<?php
namespace controllers;

use core\Controller;
use models\Contact;

class ContactController extends Controller {
    private $contactModel;

    public function __construct() {
        parent::__construct();
        $this->contactModel = new Contact();
    }

    public function index() {
        try {
            // Renderizar la vista de contacto
            $this->render('contact/index');
        } catch (\Exception $e) {
            // Log del error
            error_log('Error en ContactController::index: ' . $e->getMessage());
            
            // Redirigir a la página de error
            $this->redirect('/error');
        }
    }

    public function enviar() {
        try {
            // Verificar si es una petición POST
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new \Exception('Método no permitido');
            }

            // Validar datos del formulario
            $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
            $empresa = filter_input(INPUT_POST, 'empresa', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
            $mensaje = filter_input(INPUT_POST, 'mensaje', FILTER_SANITIZE_STRING);

            // Validar campos requeridos
            if (empty($nombre) || empty($email) || empty($mensaje)) {
                throw new \Exception('Por favor complete todos los campos requeridos');
            }

            // Validar reCAPTCHA
            $recaptchaResponse = $_POST['g-recaptcha-response'];
            if (empty($recaptchaResponse)) {
                throw new \Exception('Por favor complete el reCAPTCHA');
            }

            // Verificar reCAPTCHA con Google
            $recaptchaSecret = RECAPTCHA_SECRET_KEY;
            $recaptchaVerify = file_get_contents(
                "https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecret}&response={$recaptchaResponse}"
            );
            $recaptchaData = json_decode($recaptchaVerify);

            if (!$recaptchaData->success) {
                throw new \Exception('Error en la verificación reCAPTCHA');
            }

            // Guardar el mensaje en la base de datos
            $result = $this->contactModel->guardarMensaje([
                'nombre' => $nombre,
                'empresa' => $empresa,
                'email' => $email,
                'telefono' => $telefono,
                'mensaje' => $mensaje
            ]);

            if (!$result) {
                throw new \Exception('Error al guardar el mensaje');
            }

            // Enviar email de notificación
            $this->enviarEmailNotificacion($nombre, $email, $mensaje);

            // Redirigir con mensaje de éxito
            $this->redirect('/contacto?status=success');

        } catch (\Exception $e) {
            // Log del error
            error_log('Error en ContactController::enviar: ' . $e->getMessage());
            
            // Redirigir con mensaje de error
            $this->redirect('/contacto?status=error&message=' . urlencode($e->getMessage()));
        }
    }

    private function enviarEmailNotificacion($nombre, $email, $mensaje) {
        $to = CONTACT_EMAIL;
        $subject = 'Nuevo mensaje de contacto - ' . SITE_NAME;
        
        $headers = "From: " . $email . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        $body = "
            <h2>Nuevo mensaje de contacto</h2>
            <p><strong>Nombre:</strong> {$nombre}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Mensaje:</strong></p>
            <p>{$mensaje}</p>
        ";

        mail($to, $subject, $body, $headers);
    }
} 