# Plan de Trabajo - Sistema de Control Escolar

## 1. Stack Tecnológico

| Tecnología | Versión | Propósito |
|------------|---------|-----------|
| Laravel | 13 | Framework PHP |
| PHP | 8.3+ | Runtime |
| Livewire | 4 | Componentes dinámicos |
| Flux UI | 2 | Componentes UI |
| TailwindCSS | 4 | Estilos |
| Spatie Laravel Permission | latest | Roles y permisos |
| MySQL | 8.0+ | Base de datos |
| Laragon | latest | Entorno local |

## 2. Arquitectura de Vistas

### Estructura de directorios

```
resources/views/
├── components/
│   └── layouts/
│       └── app.blade.php          # Componente principal
├── layouts/
│   └── app/
│       ├── sidebar.blade.php      # Solo navegación lateral
│       └── navigation/            # Navegación por rol
│           ├── admin.blade.php
│           ├── direccion.blade.php
│           ├── docente.blade.php
│           └── tutor.blade.php
```

### Componente Principal (`app.blade.php`)

```blade
<x-layouts.app>
    {{ $slot }}
</x-layouts.app>
```

Debe contener:
- ✅ Sidebar fijo
- ✅ Contenido principal responsive
- ✅ Toast notifications
- ✅ Scripts de Flux
- ✅ Soporte dark mode
- ✅ `<flux:main class="lg:ml-72">` para el contenido

### Sidebar (`sidebar.blade.php`)

**SÍ debe contener:**
- Menú lateral dinámico
- Usuario autenticado
- Logout
- Navegación filtrada por rol

**NO debe contener:**
- `$slot`
- `<flux:main>`
- Contenido principal

## 3. Roles del Sistema

| Rol | Acceso | Descripción |
|-----|--------|-------------|
| Super Admin | Total | Acceso completo al sistema |
| Administrador | Admin | Administración operativa |
| Director | Dirección | Panel de dirección |
| Subdirector | Dirección | Panel de dirección restringido |
| Docente | Docente | Panel docente |
| Tutor | Tutor | Solo portal tutor |

> **Regla de rol único:** Cada usuario tiene UN solo rol. Un Director NUNCA puede ser Docente. Un Docente NUNCA puede tener acceso de Director. Esto se implementa mediante middleware de rutas, NO mediante multi-rol en Spatie.

## 4. Modelo de Datos (Base de Datos)

### Tablas Principales

| Tabla | Propósito |
|-------|-----------|
| `users` | Usuarios del sistema (auth) |
| `docentes` | Datos del personal docente (relación 1:1 con users) |
| `tutores` | Datos del tutor (relación 1:1 con users) |
| `padres` | Datos de padres/familiares |
| `alumnos` | Datos de estudiantes |
| `ciclos_escolares` | Ciclos escolares (2024-2025, etc.) |
| `grados` | Grados (1°, 2°, 3°, etc.) |
| `grupos` | Grupos (A, B, C, etc.) |
| `grupos_ciclo_escolar` | Grupos activos en un ciclo |
| `materias` | Catálogo de materias |
| `materias_grado_ciclo` | Materias por grado y ciclo |
| `inscripciones` | Inscripciones de alumnos a grupos |
| `periodos_evaluacion` | Periodos de evaluación |
| `calificaciones` | Calificaciones por alumno/materia/periodo |
| `asistencias` | Registro de asistencia |
| `justificantes_asistencia` | Justificantes de faltas |
| `alumno_padre` | Relación alumno-padre |
| `tutor_alumno` | Relación tutor-alumno |
| `asignaciones_docente_grupo` | Docentes asignados a grupos |

### Relaciones Clave

```
users (1:1) → docentes | tutores
alumnos ← (N:M) → padres (via alumno_padre)
alumnos ← (N:1) → tutores (via tutor_alumno)
grupos_ciclo_escolar → ciclos_escolares, grados, grupos
inscripciones → alumnos, grupos_ciclo_escolar
calificaciones → inscripciones, materias, periodos_evaluacion
asistencias → inscripciones
```

### Índices Existentes

- `idx_alumnos_curp` - Búsqueda por CURP
- `idx_alumnos_matricula` - Búsqueda por matrícula
- `idx_inscripciones_alumno` - Historial de inscripciones
- `idx_inscripciones_grupo` - Alumnos por grupo
- `idx_asistencias_fecha` - Asistencia por fecha
- `idx_calificaciones_inscripcion` - Calificaciones por inscripción
- `idx_calificaciones_periodo` - Calificaciones por periodo

## 5. Módulos del Sistema

### Módulo 1: Autenticación y Usuarios
- [ ] Laravel Fortify (login, register, reset password)
- [ ] Spatie Laravel Permission (roles únicos, NO multi-rol)
- [ ] CRUD Usuarios
- [ ] Gestión de Roles
- [ ] Middleware de rutas por rol (protección Director↔Docente)

### Módulo 2: Gestión Académica
- [ ] Alumnos (CRUD + CURP, teléfono, dirección)
- [ ] Padres/Familiares (CRUD)
- [ ] Ciclos Escolares
- [ ] Grados y Grupos
- [ ] Grupos Ciclo Escolar (cupo máximo)
- [ ] Sistema de Inscripciones

### Módulo 3: Operación Académica
- [ ] Docentes (CRUD + número empleado, especialidad)
- [ ] Materias (CRUD + clave única)
- [ ] Materias por Grado-Ciclo
- [ ] Asignaciones Docente-Grupo
- [ ] Calificaciones (por periodo)
- [ ] Asistencia (estatus: asistencia, falta, retardo, justificada)
- [ ] Justificantes de asistencia

### Módulo 4: Portal Tutor
- [ ] Vista de hijos inscritos
- [ ] Ver calificaciones
- [ ] Ver asistencia
- [ ] NO acceso al admin

### Módulo 5: Reportes
- [ ] Reportes académicos
- [ ] Kardex
- [ ] Estadísticas
- [ ] Exportación (PDF, Excel)

## 6. Fases de Implementación

### Fase 1: Fundamentos (Semanas 1-2)
```
1.1 Configuración de entorno Laragon + MySQL
1.2 Instalación Laravel 13 + dependencias
1.3 Importar control_escolar.sql
1.4 Auth con Fortify + Spatie
1.5 Modelos Eloquent (User, Alumno, Docente, Tutor, etc.)
1.6 Layout base con Flux UI
1.7 Sidebar dinámico por roles
```

### Fase 2: Gestión Académica (Semanas 3-4)
```
2.1 CRUD Alumnos + Padres + Relaciones
2.2 CRUD Ciclos Escolares
2.3 CRUD Grados y Grupos
2.4 CRUD Grupos Ciclo Escolar
2.5 Sistema de Inscripciones
```

### Fase 3: Operación (Semanas 5-6)
```
3.1 CRUD Docentes
3.2 CRUD Materias + MateriasGradoCiclo
3.3 Asignaciones Docente-Grupo
3.4 Módulo Calificaciones
3.5 Módulo Asistencia
3.6 Portal Tutor
```

### Fase 4: Reportes y Mejoras (Semanas 7-8)
```
4.1 Reportes académicos
4.2 Kardex por alumno
4.3 Dashboard por rol
4.4 Pruebas (Pest)
4.5 Ajustes y documentación
```

## 7. Convenciones de Código

- **Modelos:** PascalCase (`CicloEscolar`, `Grupo`, `Alumno`)
- **Tablas:** snake_plural (`ciclos_escolares`, `grupos`)
- **Componentes Livewire:** PascalCase (`GestionAlumnos`)
- **Rutas:** kebab-case (`admin.alumnos.index`)
- **Foreign Keys:** `fk_{tabla}_{campo}` (según SQL)
- **Testing:** Pest, Coverage mínimo 70%

## 8. UI/UX

- Flux UI para: modals, tables, forms, tabs, badges, date-picker
- TailwindCSS para estilos personalizados
- Dark mode integrado
- Responsive: Mobile first
- Icons: Heroicons o Lucide
- Estados de asistencia: badges de colores (verde/rojo/amarillo)

## 9. Pendientes por Definir

- [ ] ¿Campos adicionales en Alumno? (Foto, seguro, etc.)
- [ ] ¿Integración con externo? (API, sincronización)
- [ ] ¿Horario por grupo? (no está en el SQL actual)