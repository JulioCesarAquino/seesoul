# Plataforma SaaS de Gestão para Psicologia

**Versão:** 1.0.0
**Data:** 14/08/2026
**Status:** Planejamento e discussão

## 1. Visão do produto

Plataforma SaaS de gestão para psicólogos autônomos e clínicas de psicologia.

Uma psicóloga individual e uma clínica utilizarão a mesma aplicação, diferenciadas por Tenant, usuários, permissões, configurações e plano.

Principais objetivos:

- Agenda.
- Pacientes.
- Psicólogos e colaboradores.
- Atendimentos.
- Prontuários e evoluções.
- Financeiro.
- Repasse aos psicólogos.
- Convênios.
- Administração.
- Portal e aplicativos futuros.

## 2. Público-alvo

### Psicóloga individual

Uma psicóloga autônoma será um Tenant com estrutura simplificada:

```text
Ana Psicologia
├── Ana → Administradora/Psicóloga
├── Pacientes
├── Agenda
├── Atendimentos
└── Financeiro
```

### Clínica

```text
Clínica Vida
├── Administradores
├── Recepcionistas
├── Psicólogos
├── Parceiros
├── Pacientes
├── Agenda
├── Financeiro
└── Convênios
```

Não haverá dois sistemas diferentes.

## 3. SaaS e Multi-tenancy

Cada cliente é um Tenant.

Exemplos:

```text
clinicavida.seusite.com
ana.seusite.com
institutopsi.seusite.com
```

O domínio principal será usado para landing page, cadastro e informações comerciais.

Será utilizado Wildcard DNS:

```text
*.seusite.com
```

Novos subdomínios serão provisionados logicamente pela aplicação, sem necessidade de criar manualmente um registro DNS para cada cliente.

### Tenant

Representa uma organização/conta.

Pode ser:

- Psicóloga individual.
- Clínica.

### Usuário em múltiplos Tenants

Um usuário poderá pertencer a vários Tenants:

```text
Maria
├── Clínica A → Administradora
├── Clínica B → Administradora
└── Clínica C → Psicóloga
```

Modelo:

```text
users
   ↓
tenant_users
   ↓
tenants
```

O papel e as permissões são considerados dentro do contexto do Tenant.

### Tenant ativo

Fluxo:

```text
Request
↓
Identificação do domínio
↓
Identificação do Tenant
↓
Autenticação
↓
Validação do acesso do usuário
↓
Operação
```

O backend sempre deve validar o Tenant atual.

### Isolamento

Dados de um Tenant não podem ser acessados por outro sem uma regra explícita de compartilhamento.

Entidades de negócio normalmente terão `tenant_id`, por exemplo:

- patients
- appointments
- medical_records
- financial_transactions
- psychologists
- documents

O frontend nunca será considerado mecanismo de segurança.

## 4. Identidade: User, Person e vínculos

### User

Representa a identidade de acesso:

```text
users
- id
- name
- email
- password
- status
- timestamps
```

Um User pode acessar vários Tenants.

### Person

Representa uma pessoa física:

```text
persons
- id
- name
- cpf
- birth_date
- phone
- email
- timestamps
```

Uma Person pode existir sem login.

### User e Person

Quando necessário, uma Person poderá possuir um User:

```text
Person: João
    ↓
User
    ↓
Portal do Paciente
```

## 5. Pacientes

Paciente será o vínculo da pessoa com um Tenant, não simplesmente um cadastro global transferível.

```text
Person
├── Patient → Clínica A
└── Patient → Clínica B
```

Uma pessoa poderá ser paciente em várias clínicas.

Os dados clínicos permanecem isolados:

```text
Clínica A
└── João
    └── Prontuário A

Clínica B
└── João
    └── Prontuário B
```

A existência da mesma pessoa em dois Tenants não concede acesso automático ao prontuário.

### Compartilhamento futuro

Poderá existir:

```text
Clínica B
↓
Solicitação
↓
Consentimento/autorização
↓
Compartilhamento controlado
```

Não faz parte do MVP.

### Detecção de duplicidade

O sistema poderá detectar possíveis correspondências por CPF, nome, data de nascimento, telefone e outros dados, mas uma correspondência não concede acesso automático ao histórico clínico.

## 6. Papéis e permissões

Papéis previstos:

- Administrador.
- Psicólogo.
- Recepcionista.
- Paciente.
- Parceiro (futuro).

Tecnologia:

**Spatie Laravel Permission**

A autorização deve considerar:

1. Usuário.
2. Tenant.
3. Papel.
4. Permissão.
5. Relação com o recurso.

## 7. Autenticação

Tecnologia escolhida:

**Laravel Sanctum**

JWT foi considerado inicialmente, mas foi substituído por Sanctum.

Arquitetura:

```text
React Web
     ↓
Laravel API + Sanctum

App Psicólogo
     ↓
Laravel API + Sanctum

App Paciente
     ↓
Laravel API + Sanctum
```

Funcionalidades:

- Login.
- Logout.
- Recuperação de senha.
- Sessões/tokens.
- Revogação.
- Controle de acesso por Tenant.

## 8. Stack

### Backend

- PHP 8.4
- Laravel 12

### Frontend

- React 19
- Vite 7
- Tailwind CSS 4

### Banco

- PostgreSQL 17

### Cache e filas

- Redis 8

### Autenticação

- Laravel Sanctum

### Autorização

- Spatie Laravel Permission

### Pagamentos

- Mercado Pago

### Infraestrutura

- Docker
- Docker Compose

### Versionamento

- Git
- GitHub

## 9. Arquitetura da aplicação

Será utilizado inicialmente um monólito modular.

Não serão utilizados microserviços no início.

```text
React
↓
Laravel API
↓
Controllers
↓
Services / Actions
↓
Models
↓
PostgreSQL
```

Componentes:

```text
Laravel
├── Sanctum
├── Spatie Permission
├── Redis
├── Storage
├── Notifications
└── Mercado Pago
```

Controllers não devem concentrar regras complexas de negócio.

Services/Actions concentram regras de negócio.

Repositories não serão obrigatórios; serão utilizados apenas quando trouxerem benefício real.

## 10. Domínios

```text
Identity
Tenancy
Clinical
Scheduling
Financial
Billing
Notifications
Reports
```

### Identity

- Users
- Autenticação
- Roles
- Permissions

### Tenancy

- Tenants
- Tenant users
- Planos
- Features
- Configurações
- Assinaturas

### Clinical

- Persons
- Patients
- Psychologists
- Attendances
- Medical records
- Evolutions
- Documents

### Scheduling

- Disponibilidade
- Horários
- Agendamentos
- Bloqueios

### Financial

- Recebimentos
- Pagamentos
- Repasse
- Convênios
- Faturamento

### Billing

- Planos do SaaS
- Features
- Assinaturas
- Cobranças do SaaS
- Mercado Pago

### Notifications

- E-mail
- Notificações internas
- WhatsApp futuro

### Reports

- Relatórios
- Indicadores
- Dashboards

## 11. Agenda

Módulo central.

Funcionalidades:

- Disponibilidade.
- Horários.
- Agendamento.
- Confirmação.
- Cancelamento.
- Remarcação.
- Bloqueios.
- Faltas.
- Encaixes.
- Conflitos.
- Recorrência, se necessária.

Entidades iniciais:

```text
Psychologist
Availability
Appointment
ScheduleBlock
```

## 12. Psicólogos

Dados e recursos:

- Cadastro.
- Dados profissionais.
- CRP.
- Especialidades.
- Valor do atendimento.
- Regras de repasse.
- Agenda.
- Disponibilidade.
- Atendimentos.

A possibilidade de um psicólogo atuar em vários Tenants será detalhada na modelagem.

## 13. Atendimento clínico

Estados possíveis:

```text
Agendado
Confirmado
Realizado
Cancelado
Faltou
```

O atendimento poderá alimentar:

- Prontuário.
- Financeiro.
- Repasse.
- Relatórios.

## 14. Prontuário

Possíveis recursos:

- Evolução.
- Anotações.
- Documentos.
- Anexos.
- Histórico.
- Auditoria.

O acesso deverá ser rigorosamente controlado.

## 15. Financeiro da clínica

É diferente do financeiro do SaaS.

A clínica poderá controlar:

- Particular.
- Convênio.
- Recebimentos.
- Pendências.
- Repasses.
- Pagamentos.
- Fechamentos.
- Relatórios.

## 16. Repasse

O sistema deverá consolidar quanto cada psicólogo tem a receber.

Exemplo:

```text
Psicólogo: Ana
Atendimentos: 42
Valor por atendimento: R$ X

Total bruto: R$ XXXX
Ajustes: R$ XXX
Total a pagar: R$ XXXX
```

As regras detalhadas serão definidas no módulo financeiro.

## 17. Convênios

Planejado:

- Operadoras.
- Contratos.
- Tabelas de preços.
- Valores por procedimento.
- Autorizações.
- Quantidade de sessões.
- Faturamento.
- Glosas.

## 18. Financeiro do SaaS

Separado do financeiro da clínica.

```text
Cliente
↓
Plano SaaS
↓
Mercado Pago
↓
Assinatura
↓
Webhook
↓
Laravel
↓
Ativação/atualização
```

## 19. Planos e Features

Exemplos:

```text
Solo
Clínica
Enterprise
```

Features possíveis:

- Agenda.
- Financeiro.
- Convênios.
- Repasse.
- Portal do paciente.
- API.
- Relatórios.

Conceito:

```text
plans
features
plan_features
subscriptions
```

Exemplo:

```php
$tenant->hasFeature('financeiro');
```

## 20. Mercado Pago

Usado para o faturamento do SaaS.

Recursos esperados:

- Checkout.
- Cartão.
- PIX.
- Boleto.
- Assinaturas.
- Cobranças.
- Webhooks.

Integração desacoplada:

```text
PaymentGatewayInterface
        ↓
MercadoPagoGateway
```

Assim outro gateway poderá ser adicionado futuramente.

## 21. Provisionamento automático

Fluxo:

```text
Cadastro
↓
Escolha do plano
↓
Escolha do subdomínio
↓
Pagamento
↓
Webhook Mercado Pago
↓
Criação do Tenant
↓
Criação do administrador
↓
Configuração do plano/features
↓
Comunicação
↓
Conta liberada
```

Serviço previsto:

```text
TenantProvisioningService
```

## 22. Assinaturas

Estados possíveis:

```text
Ativa
Pagamento pendente
Inadimplente
Período de tolerância
Bloqueada
Cancelada
```

Dados não devem ser apagados imediatamente após inadimplência.

## 23. Auditoria

Deverá existir auditoria para eventos importantes:

- Login.
- Alteração de permissões.
- Acesso a prontuário.
- Criação/alteração de evolução.
- Exclusão.
- Alterações financeiras.
- Alterações de repasse.
- Alterações de dados sensíveis.

Exemplo:

```text
Data: 14/08/2026 14:32
Usuário: Ana
Tenant: Clínica Vida
Ação: alteração de evolução
Paciente: João
```

## 24. LGPD e segurança

O sistema tratará dados pessoais e dados relacionados à saúde.

Considerar desde o início:

- LGPD.
- Controle de acesso.
- Isolamento.
- Auditoria.
- Criptografia quando aplicável.
- Backup.
- Retenção.
- Exclusão.
- Exportação.
- Consentimento quando necessário.
- Segurança de arquivos.
- Segurança de credenciais.
- Logs sem exposição desnecessária.

Políticas jurídicas definitivas deverão ser validadas por profissional especializado.

## 25. Arquivos

Possíveis arquivos:

- PDFs.
- Documentos.
- Imagens.
- Anexos de prontuário.

Preferência: object storage compatível com S3, em vez de guardar binários diretamente no PostgreSQL.

Controle de acesso por Tenant e permissões.

## 26. Backup e recuperação

- Backups automáticos.
- Retenção definida.
- Backup externo.
- Processo de restauração.
- Testes periódicos de restauração.

## 27. Notificações

Arquitetura preparada para:

- E-mail.
- Notificações internas.
- Lembretes.
- Confirmações.
- Cancelamentos.
- Cobranças.
- WhatsApp futuro.

Redis poderá ser utilizado para filas.

## 28. Timezone

Cada Tenant terá configuração de timezone.

Exemplo:

```text
America/Sao_Paulo
```

Preferência arquitetural: armazenar datas internamente em UTC e converter para o timezone do Tenant na apresentação.

## 29. Portal do paciente — futuro

- Conta.
- Agenda.
- Consultas.
- Agendamento.
- Remarcação.
- Cancelamento.
- Documentos autorizados.
- Pagamentos.
- Solicitações.
- Comunicação.

O acesso não concede automaticamente acesso ao prontuário completo.

## 30. App do psicólogo — futuro

- Agenda.
- Pacientes.
- Atendimentos.
- Prontuário.
- Evoluções.
- Documentos.
- Financeiro.
- Notificações.

## 31. App do paciente — futuro

- Agenda.
- Consultas.
- Agendamento.
- Remarcação.
- Cancelamento.
- Pagamentos.
- Documentos.
- Notificações.
- Solicitações.

## 32. API

A API atenderá:

```text
React Web
App Psicólogo
App Paciente
Integrações futuras
```

Exemplos:

```text
/api/auth
/api/tenants
/api/users
/api/patients
/api/psychologists
/api/appointments
/api/attendances
/api/medical-records
/api/financial
/api/subscriptions
```

Todas as rotas deverão respeitar autenticação, autorização e Tenant atual.

## 33. Roadmap

### Fase 0 — Fundação

- Projeto.
- Docker.
- Laravel.
- React.
- PostgreSQL.
- Redis.
- API.
- Padrões.
- Logs.
- Erros.
- Testes.
- CI/CD.

### Fase 1 — Identity e Multi-tenancy

- Users.
- Tenants.
- TenantUsers.
- Sanctum.
- Roles.
- Permissions.
- Login.
- Recuperação de senha.
- Subdomínios.
- Tenant ativo.
- Isolamento.

### Fase 2 — Pessoas e profissionais

- Persons.
- Patients.
- Psychologists.
- Staff.
- Dados cadastrais.
- Especialidades.
- Dados profissionais.

### Fase 3 — Agenda

- Disponibilidade.
- Agenda.
- Appointments.
- Bloqueios.
- Confirmação.
- Cancelamento.
- Remarcação.
- Faltas.
- Conflitos.

### Fase 4 — Atendimento clínico

- Attendances.
- Medical Records.
- Evolutions.
- Documents.
- Attachments.
- Auditoria.

### Fase 5 — Financeiro

- Recebimentos.
- Pagamentos.
- Repasse.
- Fechamentos.
- Relatórios.

### Fase 6 — Convênios

- Operadoras.
- Contratos.
- Tabelas.
- Autorizações.
- Faturamento.
- Glosas.

### Fase 7 — Billing do SaaS

- Planos.
- Features.
- Assinaturas.
- Mercado Pago.
- Webhooks.
- Provisionamento.
- Inadimplência.

### Fase 8 — Portal do paciente

- Conta.
- Agenda.
- Consultas.
- Solicitações.
- Documentos.
- Pagamentos.

### Fase 9 — Aplicativos

- App Psicólogo.
- App Paciente.

### Fase 10 — Automação e IA

- WhatsApp.
- Lembretes automáticos.
- IA.
- BI.
- Dashboards.
- Automações.

## 34. Modelagem conceitual inicial

Primeiras entidades:

```text
User
Tenant
TenantUser
Person
Patient
Psychologist
Appointment
```

Depois:

```text
Availability
ScheduleBlock
Attendance
MedicalRecord
Evolution
Document
FinancialTransaction
ProfessionalPayment
Insurance
Plan
Feature
Subscription
Notification
AuditLog
```

A modelagem física será feita após validar os relacionamentos e regras.

## 35. Princípios arquiteturais

1. Um sistema para clínica e psicóloga individual.
2. Multi-tenancy.
3. Usuário pode pertencer a vários Tenants.
4. User é separado de Person.
5. Patient representa vínculo Person → Tenant.
6. Dados clínicos são isolados por Tenant.
7. Backend garante segurança e isolamento.
8. API-first.
9. Monólito modular.
10. Integrações externas desacopladas.
11. Evolução incremental.

## 36. Pontos ainda abertos

Não precisam bloquear o início do projeto, mas serão definidos nos respectivos módulos:

- Psicólogo em vários Tenants simultaneamente.
- Regras detalhadas de repasse.
- Regras de convênios.
- Modelo definitivo de prontuário.
- Retenção de dados.
- Consentimentos.
- Exclusão/anonimização.
- Storage definitivo.
- Provedor de e-mail.
- WhatsApp.
- Monitoramento.
- Preços.
- Inadimplência.
- Domínio definitivo.
- Domínio personalizado por Tenant.

## 37. Próxima etapa

Antes das funcionalidades, detalhar:

1. Modelo conceitual do banco.
2. Relacionamentos.
3. Regras de Multi-tenancy.
4. User, Person, Patient e Psychologist.
5. Autenticação e seleção de Tenant.
6. Primeiras migrations.

## 38. Estado das decisões

| Item | Status |
|---|---|
| SaaS | Definido |
| Clínica + psicóloga individual | Definido |
| Multi-tenant | Definido |
| Subdomínios | Definido |
| Usuário em múltiplos Tenants | Definido |
| User separado de Person | Definido |
| Patient como vínculo com Tenant | Definido |
| Isolamento de dados | Definido |
| React | Definido |
| Laravel API | Definido |
| PostgreSQL | Definido |
| Sanctum | Definido |
| Spatie Permission | Definido |
| Redis | Definido |
| Mercado Pago | Definido |
| Monólito modular | Definido |
| API-first | Definido |
| Portal do paciente | Planejado |
| Apps | Planejado |
| IA/automação | Futuro |
| Modelagem física | Próxima etapa |

## Conclusão

A plataforma será um SaaS multi-tenant para gestão de psicologia, construído como um monólito modular Laravel com frontend React e API central.

A separação fundamental será:

```text
User
↓
Identidade de acesso

Person
↓
Pessoa física

Tenant
↓
Organização

TenantUser / Patient / outros vínculos
↓
Relação com a organização

Appointments / Medical Records / Evolutions / Financial
↓
Dados de negócio isolados por Tenant
```

A próxima grande etapa é a modelagem conceitual e física do banco de dados, seguida da implementação da fundação do projeto.
