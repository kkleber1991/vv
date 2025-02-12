Para uma plataforma de **Acompanhantes** quero com que acompanhantes e clientes se cadastrem com o fim de que os clientes possam ver os anuncios e as acompanhantes crie seus anúncios. Usando **Autenticação de Dois Fatores**, **Sessões Gerenciadas** e integração com **Livewire**. Quero gerenciar permissões, usando o **Spatie Laravel Permission**.  

A seguir, o planejamento para o projeto **Vitrine Virtual**.

---

## 🔹 **1. Planejamento das Permissões (Usando Laravel Jetstream)**  

### **📌 Perfis de Usuário e Responsabilidades**
| Usuário | Responsabilidades |
|---------|------------------|
| **Admin** | Gerencia usuários, anúncios, pagamentos, planos, boosters, categorias, estados, cidades e blog |
| **Acompanhante** | Gerencia seus próprios anúncios, boosters, plano e postagens de fotos e vídeos |
| **Cliente** | Apenas visualiza e interage com os anúncios |

### **📌 Como Gerenciar as Permissões?**  
Como é um marketplace de acompanhantes adultas +18 será **gerenciar permissões individualmente usando Spatie**.

---

## 🔹 **2. Permissões Detalhadas**  

| Permissão | Admin | Acompanhante | Cliente |
|-----------|-------|-------------|---------|
| Criar anúncios | ✅ | ✅ | ❌ |
| Editar/excluir anúncios | ✅ | ✅ (somente os próprios) | ❌ |
| Criar boosters | ✅ | ✅ | ❌ |
| Editar/excluir boosters | ✅ | ✅ | ❌ |
| Criar planos | ✅ | ❌ | ❌ |
| Atribuir plano a usuários | ✅ | ❌ | ❌ |
| Postar fotos e vídeos no perfil | ❌ | ✅ | ❌ |
| Criar categorias para acompanhantes | ✅ | ❌ | ❌ |
| Gerenciar estados e cidades | ✅ | ❌ | ❌ |
| Criar postagens no blog | ✅ | ❌ | ❌ |
| Gerenciar pagamentos | ✅ | ❌ | ❌ |
| Visualizar anúncios | ✅ | ✅ | ✅ |
| Interagir com anúncios (mensagens, likes, etc.) | ✅ | ✅ | ✅ |

---

## 🔹 **3. Usuários e permissões a serem criado**
### **📌 Perfis de Usuário e Responsabilidades**
| Email | Senha | Usuário |
|---------|---------|---------|
| **admin@gmail.com** | killbill1020 | admin |
| **acompanhante@gmail.com** | killbill1020 | acompanhante |
| **cliente@gmail.com** | killbill1020 | cliente |  