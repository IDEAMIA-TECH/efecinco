        </main>
        <footer class="admin-footer">
            <div class="footer-content">
                <p>&copy; <?php echo date('Y'); ?> Efecinco. Todos los derechos reservados.</p>
                <p>Versión 1.0</p>
            </div>
        </footer>
    </div>

    <style>
        .admin-footer {
            background: #fff;
            padding: 1rem 2rem;
            margin-top: auto;
            box-shadow: 0 -2px 4px rgba(0,0,0,0.05);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .footer-content p {
            margin: 0;
        }

        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
            }
        }
    </style>

    <?php if (isset($scripts_adicionales)): ?>
        <?php echo $scripts_adicionales; ?>
    <?php endif; ?>
</body>
</html> 
 
 