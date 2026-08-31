# SeeSoul

Plataforma SaaS de gestão para psicólogos autônomos e clínicas de psicologia.

## Estrutura

```
api/   Laravel 12 (API) — PHP 8.4, PostgreSQL 17, Redis 8
web/   React 19 + Vite + Tailwind CSS 4
```

Fase 1 (Identity e Multi-tenancy) em andamento: Users, Tenants, TenantUsers, Sanctum (token) e Spatie Permission (roles/permissions por tenant, via teams) já implementados. Ver roadmap completo na documentação.

### Autenticação e tenants

- `POST /api/login` — `{ email, password }` → token + tenants do usuário.
- `GET /api/me` — dados do usuário autenticado (`Authorization: Bearer <token>`).
- `POST /api/logout` — invalida o token atual.
- `POST /api/forgot-password` / `POST /api/reset-password` — recuperação de senha (link aponta pro `FRONTEND_URL`).
- `GET /api/tenant` — requer `auth:sanctum` + header `Host: <subdominio>.localhost` resolvendo o tenant ativo; 403 se o usuário não pertencer a ele.

Tenant é resolvido pelo subdomínio do `Host` da requisição (ex: `clinica-teste.localhost`). Isolamento de dados entre tenants é feito via `App\Models\Concerns\BelongsToTenant` (global scope por `tenant_id`), a ser usado pelos models das próximas fases.

## Rodando o ambiente

```bash
cp .env.example .env
docker compose up -d --build
```

> Nesta máquina, o `docker compose` (v2.11.2) negocia uma versão de API antiga demais para o daemon instalado.
> Se der o erro "client version ... is too old", rode com `DOCKER_API_VERSION=1.44` na frente do comando
> (ex: `DOCKER_API_VERSION=1.44 docker compose up -d`), ou atualize o plugin do Compose.

- API: http://localhost:8090
- Web: http://localhost:5173

Portas ajustadas para não colidir com outros projetos já rodando nesta máquina (porta 80, 5432/5433/5434 e 6379/6380 já estavam em uso). Ajuste em `.env` se precisar.

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
