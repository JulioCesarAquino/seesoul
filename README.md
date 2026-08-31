# SeeSoul

Plataforma SaaS de gestão para psicólogos autônomos e clínicas de psicologia.

## Estrutura

```
api/   Laravel 12 (API) — PHP 8.4, PostgreSQL 17, Redis 8
web/   React 19 + Vite + Tailwind CSS 4
```

Fase 1 (Identity e Multi-tenancy) e Fase 2 (Pessoas e profissionais) implementadas. Ver roadmap completo na documentação.

### Arquitetura do backend (Package by Feature)

O `api/app` é organizado por domínio (seção 10 da documentação), não por tipo de arquivo:

```
app/
  Models/{Identity,Tenancy,Clinical}/...
  Http/Controllers/{Identity,Tenancy,Clinical}/...
  Http/Requests/{Identity,Clinical}/...
  Services/{Identity,Tenancy,Clinical}/...
```

- **Identity** — `User`, autenticação (login/logout/me/recuperação de senha).
- **Tenancy** — `Tenant`, isolamento por `tenant_id` (`BelongsToTenant`, `TenantScope`, `TenantContext`).
- **Clinical** — `Person`, `Patient`, `Psychologist`, `Staff`, `Specialty`.

Controllers são **single action** (`__invoke()`), nomeados `{Substantivo}{Verbo}Controller` (ex: `PatientStoreController`). Validação fica em `Http\Requests\{Domínio}\{Substantivo}{Verbo}Request`. Regra de negócio de escrita (store/update/destroy) fica numa classe `Services\{Domínio}\{Substantivo}{Verbo}Service` com método `execute()`; leituras (index/show) ficam direto no controller, sem Service.

### Autenticação e tenants

- `POST /api/login` — `{ email, password }` → token + tenants do usuário.
- `GET /api/me` — dados do usuário autenticado (`Authorization: Bearer <token>`).
- `POST /api/logout` — invalida o token atual.
- `POST /api/forgot-password` / `POST /api/reset-password` — recuperação de senha (link aponta pro `FRONTEND_URL`).
- `GET /api/tenant` — requer `auth:sanctum` + header `Host: <subdominio>.localhost` resolvendo o tenant ativo; 403 se o usuário não pertencer a ele.

Tenant é resolvido pelo subdomínio do `Host` da requisição (ex: `clinica-teste.localhost`). Isolamento de dados entre tenants é feito via `App\Models\Tenancy\Concerns\BelongsToTenant` (global scope por `tenant_id`), usado pelos models de Pessoas/Pacientes/Psicólogos/Staff abaixo.

### Pessoas e profissionais

Todas as rotas abaixo exigem `auth:sanctum` + header `Host: <subdominio>.localhost` (exceto `specialties`, que é um catálogo global):

- `GET/POST /api/patients`, `GET/PUT/DELETE /api/patients/{id}` — pacientes do tenant ativo.
- `GET/POST /api/psychologists`, `GET/PUT/DELETE /api/psychologists/{id}` — psicólogos do tenant ativo (CRP, valor de atendimento, especialidades via `specialty_ids`).
- `GET/POST /api/staff`, `GET/PUT/DELETE /api/staff/{id}` — equipe administrativa/recepção do tenant ativo.
- `GET/POST/PUT/DELETE /api/specialties` — catálogo global de especialidades (não é por tenant).

`Person` é uma entidade global (dado civil: nome, CPF, data de nascimento, telefone, email, endereço) — uma mesma pessoa pode ser paciente/psicólogo/staff em vários tenants diferentes, mas cada vínculo (`Patient`/`Psychologist`/`Staff`) é isolado por tenant. Ao criar um paciente/psicólogo/staff, o sistema procura uma `Person` existente pelo CPF antes de criar uma nova (detecção de duplicidade). As regras de validação e a lista de campos de `Person` ficam centralizadas em `Person::rules()` / `Person::fieldNames()`, reaproveitadas pelas Requests de Patient/Psychologist/Staff.

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
