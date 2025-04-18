-- Agregar campo infraestructura_comunicaciones a la tabla cotizaciones_acceso
ALTER TABLE cotizaciones_acceso
ADD COLUMN infraestructura_comunicaciones VARCHAR(20) NOT NULL AFTER red_internet;

-- Agregar campo infraestructura_comunicaciones a la tabla cotizaciones_camaras
ALTER TABLE cotizaciones_camaras
ADD COLUMN infraestructura_comunicaciones VARCHAR(20) NOT NULL AFTER red_internet; 