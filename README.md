# SeeSoul

Plataforma SaaS de gestão para psicólogos autônomos e clínicas de psicologia.

## Estrutura

```
api/   Laravel 12 (API) — PHP 8.4, PostgreSQL 17, Redis 8, Sanctum, Spatie Permission
web/   React 19 + Vite + Tailwind CSS 4
```

## Rodando o ambiente

```bash
cp .env.example .env
docker compose up -d --build
```

- API: http://localhost
- Web: http://localhost:5173

Primeira vez, rodar as migrations:

```bash
docker compose exec api php artisan migrate
```

## Comandos úteis

```bash
docker compose exec api php artisan ...
docker compose exec api composer ...
docker compose exec web npm ...
docker compose logs -f
docker compose down
```

## Documentação

Ver [`docs/documentacao-completa-saas-psicologia-v1.md`](docs/documentacao-completa-saas-psicologia-v1.md) para a visão de produto, domínios, roadmap e decisões de arquitetura.
