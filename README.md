# Clavibase full-stack assessment

Clavibase is a shortlet operations platform for Nigeria. Hosts use it to run furnished stays across Lagos: listings, availability, and the day-to-day of a shortlet.

This repository is a take-home assessment for full-stack intern candidates. Nothing you build here will be used in the Clavibase product.

## The task

Build a small listings feature on top of the starter in this repo.

1. **REST API.** A CRUD API for property listings in the Laravel app (`backend/`). Create, read, update, and delete a listing.
2. **Filtered list.** The list endpoint filters by area, price range (`min` and `max`, in NGN per night), and number of bedrooms, and it paginates results.
3. **Listing page.** A Nuxt (or Vue) page in `frontend/` that lists the properties and exposes those same filters.
4. **Candidate notes.** Replace the [Candidate notes](#candidate-notes) section below with your own write-up: how you set the project up, the decisions you made, and what you would improve with more time.

The `Property` model, migration, and a seeder of about 20 Lagos listings are already in place. Listing routes and controllers are left for you. The Nuxt 4 index page is a placeholder.

Prices are integers in naira per night. Seeded areas are Lekki, Ikoyi, Yaba, Victoria Island, Ajah, Surulere, and Ikeja. `description` may be null. `is_available` is a boolean.

How you shape URLs, query parameters, validation, and the JSON response is part of the assessment. Prefer a clear API over a clever one.

## Stretch goal

Pick **one**, or skip this if you are out of time. Do not do all three.

- **Booking overlap check.** A guest should not be able to double-book a listing. Given a check-in and check-out, reject a booking when those dates overlap an existing booking for the same property.
- **Simple host auth.** A host can sign in and manage only their own listings.
- **Tests.** Automated tests around the behaviour you built.

Say which one you chose in the pull request and in your notes.

## How to submit

1. Fork this repository.
2. Create a branch on your fork and do the work there.
3. Commit as you go. We read the history, not only the final diff.
4. Open a pull request to your fork's `main`, or to `main` on this repository.
5. Do not commit secrets. `.env` files, API keys, and `database.sqlite` stay local. `.env.example` is the template.

Use the pull request template: summary, stretch goal chosen, how to run, and notes or trade-offs.

## Time

Plan for about 3–5 hours of work. Submit within 72 hours of the invite. A smaller, finished slice is better than a wide one that does not run.

## What we look at

- The code runs, including the filters and pagination.
- The API is deliberate: status codes, validation, and the shape of the list response.
- The code is clear and the commit history shows how you got there.
- Your candidate notes explain the choices a reader cannot see in the diff.

If we move forward, we will spend 20–30 minutes walking through your pull request together. Be ready to explain the decisions and the trade-offs.

AI tools are allowed. You must be able to explain every line you submit.

Questions: [hello@clavibase.com](mailto:hello@clavibase.com).

## Quick start

You need PHP 8.3 or newer, Composer, pnpm, and Node.js 22.22.3+ (22.x), 24.15+, or 26+.

### Backend

From `backend/`:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

The API uses SQLite. Migrate creates `database/database.sqlite`. `php artisan serve` listens on `http://localhost:8000`. The seeder also creates Laravel's default local user, `test@example.com` / `password`.

### Frontend

From `frontend/`:

```bash
cp .env.example .env
pnpm install
pnpm dev
```

The Nuxt 4 placeholder is at `http://localhost:3000`. `NUXT_PUBLIC_API_BASE` (default `http://localhost:8000`) is exposed as `runtimeConfig.public.apiBase`.

## Candidate notes

Replace this section before you submit.

### Setup steps

### Decisions made

### What you'd improve with more time
