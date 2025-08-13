# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel 12 application with Vue 3 frontend using Inertia.js. It's a baseball-themed application that includes user authentication, organization management, and a modern UI built with Tailwind CSS and shadcn/ui components.

## Architecture

### Backend (Laravel)
- **Framework**: Laravel 12 with PHP 8.2+
- **Database**: SQLite for development (database.sqlite)
- **Authentication**: Laravel Breeze with email verification
- **API**: Server-side rendering enabled with Inertia.js
- **Testing**: Pest PHP for both Feature and Unit tests

### Frontend (Vue 3 + TypeScript)
- **Framework**: Vue 3 with TypeScript and Composition API
- **Routing**: Inertia.js for SPA-like experience
- **Styling**: Tailwind CSS v4 with shadcn/ui components
- **Icons**: Lucide Vue Next
- **State**: Vue composables (useAppearance for theming)
- **Build**: Vite with Laravel Vite plugin

### Key Models
- **User**: Standard Laravel authentication model
- **Organization**: Business entity with address fields and logo
- **Observer**: OrganizationObserver for model events

## Development Commands

### Full Development Environment
```bash
# Start all services (server, queue, logs, vite)
composer dev

# With SSR enabled
composer dev:ssr
```

### Individual Services
```bash
# Start Laravel development server
php artisan serve

# Start Vite dev server for frontend
npm run dev

# Build frontend assets
npm run build

# Build with SSR
npm run build:ssr

# Queue worker
php artisan queue:listen --tries=1

# View logs in real-time
php artisan pail --timeout=0
```

### Testing
```bash
# Run all tests (clears config first)
composer test

# Run Pest tests directly
php artisan test

# Run specific test file
php artisan test tests/Feature/DashboardTest.php

# Run with filters
php artisan test --filter="can render dashboard"
```

### Code Quality
```bash
# Format code with Laravel Pint
vendor/bin/pint

# Lint JavaScript/TypeScript
npm run lint

# Format frontend code
npm run format

# Check formatting
npm run format:check

# Type checking
npx vue-tsc --noEmit
```

### Database
```bash
# Run migrations
php artisan migrate

# Fresh migration with seeding
php artisan migrate:fresh --seed

# Create new migration
php artisan make:migration create_table_name

# Create model with migration
php artisan make:model ModelName -m
```

## Project Structure

### Backend Organization
- `app/Http/Controllers/` - Route controllers (separate Auth/ and Settings/ directories)
- `app/Models/` - Eloquent models with typed properties
- `app/Observers/` - Model observers for event handling
- `routes/` - Route definitions (web.php, auth.php, settings.php)
- `database/migrations/` - Database schema definitions
- `database/seeders/` - Data seeders

### Frontend Organization
- `resources/js/pages/` - Inertia.js page components
- `resources/js/components/` - Reusable Vue components
- `resources/js/components/ui/` - shadcn/ui component library
- `resources/js/layouts/` - Layout components (app/, auth/, settings/)
- `resources/js/composables/` - Vue composables
- `resources/js/lib/` - Utility functions
- `resources/js/types/` - TypeScript type definitions

### Testing Structure
- `tests/Feature/` - Integration tests (Auth/, Settings/ subdirectories)
- `tests/Unit/` - Unit tests
- Uses Pest PHP with Laravel plugin

## Key Configuration

### Inertia.js Setup
- SSR enabled in production
- Page resolution from `resources/js/pages/`
- Ziggy for route helpers in frontend
- Progress bar color: #4B5563

### UI Components
- Built on Reka UI (Vue port of Radix UI)
- Tailwind CSS with custom configuration
- Class variance authority for component variants
- Automatic dark/light theme detection

## Development Guidelines

### Laravel Conventions
- Follow PSR standards and Laravel conventions
- Use typed properties over docblocks
- Controllers use tuple notation: `[Controller::class, 'method']`
- Route names in camelCase, URLs in kebab-case

### Vue/TypeScript Conventions
- Use Composition API with TypeScript
- Component props with proper typing
- Composables for shared logic
- Single File Components with `<script setup>`

### Testing Approach
- Feature tests for complete user workflows
- Use factories for test data
- Pest PHP syntax with expect() assertions
- Database transactions for test isolation

## Common Workflows

### Adding New Features
1. Create migration if database changes needed
2. Create/update models with proper relationships
3. Add routes to appropriate route file
4. Create controller with typed methods
5. Create Inertia page component
6. Add navigation if needed
7. Write Feature tests for the workflow
8. Run `composer test` and `npm run lint`

### UI Component Development
1. Check `resources/js/components/ui/` for existing components
2. Follow shadcn/ui patterns for new components
3. Use Tailwind classes with `cn()` utility for merging
4. Implement proper TypeScript interfaces
5. Test component in isolation before integration

===

<laravel-boost-guidelines>
=== boost rules ===

## Laravel Boost
- Laravel Boost is an MCP server that comes with powerful tools designed specifically for this application. Use them.

## Artisan
- Use the `list-artisan-commands` tool when you need to call an Artisan command to double check the available parameters.

## URLs
- Whenever you share a project URL with the user you should use the `get-absolute-url` tool to ensure you're using the correct scheme, domain / IP, and port.

## Tinker / Debugging
- You should use the `tinker` tool when you need to execute PHP to debug code or query Eloquent models directly.
- Use the `database-query` tool when you only need to read from the database.

## Reading Browser Logs With the `browser-logs` Tool
- You can read browser logs, errors, and exceptions using the `browser-logs` tool from Boost.
- Only recent browser logs will be useful - ignore old logs.

## Searching Documentation (Critically Important)
- Boost comes with a powerful `search-docs` tool you should use before any other approaches. This tool automatically passes a list of installed packages and their versions to the remote Boost API, so it returns only version-specific documentation specific for the user's circumstance. You should pass an array of packages to filter on if you know you need docs for particular packages.
- The 'search-docs' tool is perfect for all Laravel related packages, including Laravel, Inertia, Livewire, Filament, Tailwind, Pest, Nova, Nightwatch, etc.
- You must use this tool to search for Laravel-ecosystem documentation before falling back to other approaches.
- Search the documentation before making code changes to ensure we are taking the correct approach.
- Use multiple, broad, simple, topic based queries to start. For example: `['rate limiting', 'routing rate limiting', 'routing']`.

### Available Search Syntax
- You can and should pass multiple queries at once. The most relevant results will be returned first.

1. Simple Word Searches with auto-stemming - query=authentication - finds 'authenticate' and 'auth'
2. Multiple Words (AND Logic) - query=rate limit - finds knowledge containing both "rate" AND "limit"
3. Quoted Phrases (Exact Position) - query="infinite scroll - Words must be adjacent and in that order
4. Mixed Queries - query=middleware "rate limit" - "middleware" AND exact phrase "rate limit"
5. Multiple Queries - queries=["authentication", "middleware"] - ANY of these terms


=== inertia-laravel/core rules ===

## Inertia Core

- Inertia.js components should be placed in the `resources/js/Pages` directory unless specified differently in the JS bundler (vite.config.js).
- Use `Inertia::render()` for server-side routing instead of traditional Blade views.

<code-snippet lang="php" name="Inertia::render Example">
// routes/web.php example
Route::get('/users', function () {
    return Inertia::render('Users/Index', [
        'users' => User::all()
    ]);
});
</code-snippet>


=== inertia-laravel/v2 rules ===

## Inertia v2

- Make use of all Inertia features from v1 & v2. Check the documentation before making any changes to ensure we are taking the correct approach.

### Inertia v2 New Features
- Polling
- Prefetching
- Deferred props
- Infinite scrolling using merging props and `WhenVisible`
- Lazy loading data on scroll

### Deferred Props & Empty States
- When using deferred props on the frontend, you should add a nice empty state with pulsing / animated skeleton.


=== laravel/core rules ===

## Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using the `list-artisan-commands` tool.
- If you're creating a generic PHP class, use `artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Database
- Always use proper Eloquent relationship methods with return type hints. Prefer relationship methods over raw queries or manual joins.
- Use Eloquent models and relationships before suggesting raw database queries
- Avoid `DB::`; prefer `Model::query()`. Generate code that leverages Laravel's ORM capabilities rather than bypassing them.
- Generate code that prevents N+1 query problems by using eager loading.
- Use Laravel's query builder for very complex database operations.

### Model Creation
- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `list-artisan-commands` to check the available options to `php artisan make:model`.

### APIs & Eloquent Resources
- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

### Controllers & Validation
- Always create Form Request classes for validation rather than inline validation in controllers. Include both validation rules and custom error messages.
- Check sibling Form Requests to see if the application uses array or string based validation rules.

### Queues
- Use queued jobs for time-consuming operations with the `ShouldQueue` interface.

### Authentication & Authorization
- Use Laravel's built-in authentication and authorization features (gates, policies, Sanctum, etc.).

### URL Generation
- When generating links to other pages, prefer named routes and the `route()` function.

### Configuration
- Use environment variables only in configuration files - never use the `env()` function directly outside of config files. Always use `config('app.name')`, not `env('APP_NAME')`.

### Testing
- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] <name>` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

### Vite Error
- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.


=== laravel/v12 rules ===

## Laravel 12

- Use the `search-docs` tool to get version specific documentation.
- Since Laravel 11, Laravel has a new streamlined file structure which this project uses.

### Laravel 12 Structure
- No middleware files in `app/Http/Middleware/`.
- `bootstrap/app.php` is the file to register middleware, exceptions, and routing files.
- `bootstrap/providers.php` contains application specific service providers.
- **No app\Console\Kernel.php** - use `bootstrap/app.php` or `routes/console.php` for console configuration.
- **Commands auto-register** - files in `app/Console/Commands/` are automatically available and do not require manual registration.

### Database
- When modifying a column, the migration must include all of the attributes that were previously defined on the column. Otherwise, they will be dropped and lost.
- Laravel 11 allows limiting eagerly loaded records natively, without external packages: `$query->latest()->limit(10);`.

### Models
- Casts can and likely should be set in a `casts()` method on a model rather than the `$casts` property. Follow existing conventions from other models.


=== pint/core rules ===

## Laravel Pint Code Formatter

- You must run `vendor/bin/pint` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test`, simply run `vendor/bin/pint` to fix any formatting issues.


=== pest/core rules ===

## Pest

### Testing
- If you need to verify a feature is working, write or update a Unit / Feature test.

### Pest Tests
- All tests must be written using Pest. Use `php artisan make:test --pest <name>`.
- You must not remove any tests or test files from the tests directory without approval. These are not temporary or helper files - these are core to the application.
- Tests should test all of the happy paths, failure paths, and weird paths.
- Tests live in the `tests/Feature` and `tests/Unit` directories.
- Pest tests look and behave like this:
<code-snippet name="Basic Pest Test Example" lang="php">
it('is true', function () {
    expect(true)->toBeTrue();
});
</code-snippet>

### Running Tests
- Run the minimal number of tests using an appropriate filter before finalizing code edits.
- To run all tests: `php artisan test`.
- To run all tests in a file: `php artisan test tests/Feature/ExampleTest.php`.
- To filter on a particular test name: `php artisan test --filter=testName` (recommended after making a change to a related file).
- When the tests relating to your changes are passing, ask the user if they would like to run the entire test suite to ensure everything is still passing.

### Pest Assertions
- When asserting status codes on a response, use the specific method like `assertForbidden` and `assertNotFound` instead of using `assertStatus(403)` or similar, e.g.:
<code-snippet name="Pest Example Asserting postJson Response" lang="php">
it('returns all', function () {
    $response = $this->postJson('/api/docs', []);

    $response->assertSuccessful();
});
</code-snippet>

### Mocking
- Mocking can be very helpful when appropriate.
- When mocking, you can use the `Pest\Laravel\mock` Pest function, but always import it via `use function Pest\Laravel\mock;` before using it. Alternatively, you can use `$this->mock()` if existing tests do.
- You can also create partial mocks using the same import or self method.

### Datasets
- Use datasets in Pest to simplify tests which have a lot of duplicated data. This often the case when testing validation rules, so consider going with this solutionwhen writing tests for validation rules.

<code-snippet name="Pest Dataset Example" lang="php">
it('has emails', function (string $email) {
    expect($email)->not->toBeEmpty();
})->with([
    'james' => 'james@laravel.com',
    'taylor' => 'taylor@laravel.com',
]);
</code-snippet>


=== inertia-vue/core rules ===

## Inertia + Vue

- Vue components must have a single root element.
- Use `router.visit()` or `<Link>` for navigation instead of traditional links.

<code-snippet lang="vue" name="Inertia Client Navigation">
    import { Link } from '@inertiajs/vue3'

    <Link href="/">Home</Link>
</code-snippet>

- For form handling, use `router.post` and related methods. Do not use regular forms.


<code-snippet lang="vue" name="Inertia Vue Form Example">
    <script setup>
    import { reactive } from 'vue'
    import { router } from '@inertiajs/vue3'
    import { usePage } from '@inertiajs/vue3'

    const page = usePage()

    const form = reactive({
      first_name: null,
      last_name: null,
      email: null,
    })

    function submit() {
      router.post('/users', form)
    }
    </script>

    <template>
        <h1>Create {{ page.modelName }}</h1>
        <form @submit.prevent="submit">
            <label for="first_name">First name:</label>
            <input id="first_name" v-model="form.first_name" />
            <label for="last_name">Last name:</label>
            <input id="last_name" v-model="form.last_name" />
            <label for="email">Email:</label>
            <input id="email" v-model="form.email" />
            <button type="submit">Submit</button>
        </form>
    </template>
</code-snippet>


=== tailwindcss/core rules ===

## Tailwind Core

- Use Tailwind CSS classes to style HTML, check and use existing tailwind conventions within the project before writing your own.
- Offer to extract repeated patterns into components that match the project's conventions (i.e. Blade, JSX, Vue, etc..)
- Think through class placement, order, priority, and defaults - remove redundant classes, add classes to parent or child carefully to limit repetition, group elements logically
- You can use the `search-docs` tool to get exact examples from the official documentation when needed.

### Spacing
- When listing items, use gap utilities for spacing, don't use margins.

    <code-snippet name="Valid Flex Gap Spacing Example" lang="html">
        <div class="flex gap-8">
            <div>Superior</div>
            <div>Michigan</div>
            <div>Erie</div>
        </div>
    </code-snippet>


### Dark Mode
- If existing pages and components support dark mode, new pages and components must support dark mode in a similar way, typically using `dark:`.


=== tailwindcss/v4 rules ===

## Tailwind 4

- Always use Tailwind CSS v4 - do not use the deprecated utilities.
- `corePlugins` is not supported in Tailwind v4.
- In Tailwind v4, you import Tailwind using a regular CSS `@import` statement, not using the `@tailwind` directives used in v3:

<code-snippet name="Tailwind v4 Import Tailwind Diff" lang="diff"
   - @tailwind base;
   - @tailwind components;
   - @tailwind utilities;
   + @import "tailwindcss";
</code-snippet>


### Replaced Utilities
- Tailwind v4 removed deprecated utilities. Do not use the deprecated option - use the replacement.
- Opacity values are still numeric.

| Deprecated |	Replacement |
|------------+--------------|
| bg-opacity-* | bg-black/* |
| text-opacity-* | text-black/* |
| border-opacity-* | border-black/* |
| divide-opacity-* | divide-black/* |
| ring-opacity-* | ring-black/* |
| placeholder-opacity-* | placeholder-black/* |
| flex-shrink-* | shrink-* |
| flex-grow-* | grow-* |
| overflow-ellipsis | text-ellipsis |
| decoration-slice | box-decoration-slice |
| decoration-clone | box-decoration-clone |


=== tests rules ===

## Test Enforcement

- Every change must be programmatically tested. Write a new test or update an existing test, then run the affected tests to make sure they pass.
- Run the minimum number of tests needed to ensure code quality and speed. Use `php artisan test` with a specific filename or filter.
</laravel-boost-guidelines>