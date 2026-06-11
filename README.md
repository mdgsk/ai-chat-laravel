# AI Chat Laravel

A simple AI Chat application built with Laravel and Gemini API, with support for local LLMs using Ollama.

This project is a Laravel reimplementation of a previous Core PHP AI Chat project. The goal is to build the same functionality using Laravel architecture while keeping the application simple and avoiding unnecessary complexity.

---

## Features

* Multiple conversations
* Automatic conversation ordering
* Context memory (last 5 chats)
* AJAX-based chat without page reload
* Temporary "Thinking..." card
* Markdown rendering
* Syntax highlighting
* Enter to submit
* Shift + Enter for newline
* Automatic conversation title generation
* Gemini API integration
* Ollama local LLM integration
* Gemini → Ollama fallback
* Provider and model metadata
* Error handling
* Separate logs for Gemini and Ollama
* Soft deletes
* Database relationships
* Responsive chat UI

---

## Technology Stack

### Backend

* PHP 8.2
* Laravel 12
* MySQL

### AI Providers

* Google Gemini API
* Ollama Local LLM

### Frontend

* Blade
* JavaScript
* AJAX (fetch)
* Vite

### Libraries

* league/commonmark
* highlight.js

---

## Architecture

```text
Form
↓
chat.js
↓
AJAX
↓
AjaxChatController
↓
AiService
↓
Gemini / Ollama
↓
MarkdownService
↓
JSON
↓
DOM Update
↓
No Page Reload
```

---

## Database

### conversations

```text
id
title
created_at
updated_at
deleted_at
```

### chat_histories

```text
id
conversation_id
question
answer
provider
model
time_taken
created_at
updated_at
deleted_at
```

---

## AI Provider Flow

### Normal

```text
User
↓
Gemini
↓
Response
```

### Local LLM Mode

```text
User
↓
Ollama
↓
Response
```

### Fallback Mode

```text
User
↓
Gemini
↓
Failure
↓
Ollama
↓
Response
```

Metadata example:

```text
gemini | gemini-2.5-flash

gemini → ollama | qwen2.5:7b
```

---

## Installation

Clone the repository:

```bash
git clone https://github.com/mdgsk/ai-chat-laravel.git
```

Move into the project:

```bash
cd ai-chat-laravel
```

Install PHP dependencies:

```bash
composer install
```

Install Node dependencies:

```bash
npm install
```

Copy environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

---

## Database Setup

### Option 1: Run Migrations

```bash
php artisan migrate
```

---

### Option 2: Import SQL Dump

Import:

```text
database/dump/ai_chat_laravel.sql
```

using phpMyAdmin.

---

## Environment Variables

Example:

```env
USE_LOCAL_LLM=false

FALLBACK_TO_LOCAL_LLM=true

GEMINI_SAMPLE_RESPONSE=false
GEMINI_SAMPLE_RESPONSE_SUCCESS=false

GEMINI_MODEL=gemini-2.5-flash
OLLAMA_MODEL=qwen2.5:7b

SYSTEM_PROMPT=
GEMINI_API_KEY=
```

---

## Running the Application

Start Laravel:

```bash
php artisan serve
```

Start Vite:

```bash
npm run dev
```

Open:

```text
http://127.0.0.1:8000
```

---

## Logs

Gemini logs:

```text
storage/logs/gemini.log
```

Ollama logs:

```text
storage/logs/ollama.log
```

Laravel logs:

```text
storage/logs/laravel.log
```

---

## Current Capabilities

* Create new chats
* Automatic title generation
* Context-aware responses
* Markdown support
* Syntax highlighting
* AJAX updates
* Error handling
* Local LLM support
* Gemini fallback
* Conversation ordering

---

## Author

Md Gaffar Ali Shaikh

GitHub:

https://github.com/mdgsk
