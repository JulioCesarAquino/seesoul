# SeeSoul

Plataforma SaaS de gestão para psicólogos autônomos e clínicas de psicologia.

## Estrutura

```
api/   Laravel 12 (API) — PHP 8.4, PostgreSQL 17, Redis 8
web/   React 19 + Vite + Tailwind CSS 4
```

Sanctum e Spatie Permission ainda não foram instalados — entram na Fase 1 (Identity e Multi-tenancy), ver roadmap na documentação.

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
