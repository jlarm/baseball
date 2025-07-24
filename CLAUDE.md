# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Development Commands

### Testing & Quality Assurance
- **Run all tests**: `composer test` (includes lint, refactor check, static analysis, type coverage, and unit tests)
- **Run unit tests only**: `composer test:unit` or `pest --parallel --coverage`
- **Run specific test**: `pest --filter=<test-name>`
- **Architecture tests**: `composer test:arch`
- **Type coverage**: `composer test:type-coverage` (requires 100% coverage)

### Code Quality
- **Lint code**: `composer lint` (Laravel Pint with parallel processing)
- **Check lint without fixing**: `composer test:lint`
- **Refactor code**: `composer refactor` (Rector)
- **Check refactor without changes**: `composer test:refactor`
- **Static analysis**: `composer test:types` (PHPStan level 5)

### Development
- **Start development environment**: `composer dev` (runs server, queue, logs, and Vite concurrently)
- **Build assets**: `npm run build`
- **Development assets**: `npm run dev`
- **Run artisan commands**: `php artisan <command>`

## Architecture Overview

This is a Laravel 12 application using Livewire for interactive components and Flux UI for the design system.

### Core Technologies
- **Backend**: Laravel 12 with PHP 8.2+
- **Frontend**: Livewire 3 with Volt, TailwindCSS 4, Vite 6
- **UI Framework**: Flux UI (both free and pro versions)
- **Database**: SQLite (development), with migrations and factories
- **Testing**: Pest PHP with Laravel plugin and Livewire plugin

### Application Structure

#### Authentication & User Management
- Uses Laravel's built-in authentication with email verification
- Livewire components for auth flows (`app/Livewire/Auth/`)
- User settings pages with profile, password, and appearance sections
- User model includes helper methods like `initials()` for UI display

#### Organization Management
- Organization model with observer pattern (`OrganizationObserver`)
- Organization policies for authorization
- Organization settings page as Livewire component
- Factory and seeder support for organizations

#### Livewire Architecture
- Settings are organized into separate Livewire components (`app/Livewire/Settings/`)
- Uses Flux UI components consistently across the app
- Layout system with dedicated auth and app layouts
- Component-based approach with clear separation of concerns

#### Database Design
- SQLite for development with migrations
- Factory pattern for model generation
- Seeders for development data
- Observer pattern for model lifecycle events

### Key Configuration Files
- **Code Quality**: Uses strict coding standards with Pint, Rector, and PHPStan
- **Testing**: Pest configuration with 99.4% minimum coverage requirement
- **Asset Pipeline**: Vite with TailwindCSS and Laravel plugin integration

### Development Patterns
- All classes are declared `final` by default (enforced by Pint)
- Strict types enabled (`declare(strict_types=1)`)
- Uses constructor property promotion where appropriate
- Observer pattern for model events
- Policy-based authorization
- Component-based UI architecture with Livewire

### File Organization
- Controllers follow Laravel conventions with tuple route definitions
- Models use typed properties and modern Laravel features
- Livewire components are organized by feature area
- Views follow Blade component structure with Flux UI integration
- Tests are organized into Feature and Unit categories using Pest

## Important Notes
- The application enforces high code quality standards with 100% type coverage requirement
- Uses modern Laravel patterns including attributes for observers and route definitions
- Livewire components follow single responsibility principle
- UI consistently uses Flux design system components
- Database uses SQLite for simplicity in development