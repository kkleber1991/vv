<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Resetar cache do pacote
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Criar permissões
        $permissions = [
            // Permissões de anúncios
            'criar anuncios',
            'editar anuncios',
            'excluir anuncios',
            'visualizar anuncios',
            
            // Permissões de boosters
            'criar boosters',
            'editar boosters',
            'excluir boosters',
            
            // Permissões de planos
            'manage plans',
            
            // Permissões de perfil
            'postar fotos',
            'postar videos',
            
            // Permissões de categorias
            'criar categorias',
            'gerenciar categorias',
            
            // Permissões de localização
            'gerenciar estados',
            'gerenciar cidades',
            
            // Permissões de blog
            'criar posts',
            'editar posts',
            'excluir posts',
            'gerenciar posts',
            
            // Permissões de pagamentos
            'gerenciar pagamentos',
            
            // Permissões de interação
            'enviar mensagens',
            'dar likes',
            
            // Permissões de usuários
            'manage users',
        ];

        // Criar permissões se não existirem
        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        // Criar roles se não existirem
        $admin = Role::findOrCreate('admin');
        $acompanhante = Role::findOrCreate('acompanhante');
        $cliente = Role::findOrCreate('cliente');

        // Atribuir todas as permissões para admin
        $admin->givePermissionTo(Permission::all());

        // Atribuir permissões para acompanhante
        $acompanhante->givePermissionTo([
            'criar anuncios',
            'editar anuncios',
            'excluir anuncios',
            'visualizar anuncios',
            'criar boosters',
            'editar boosters',
            'excluir boosters',
            'postar fotos',
            'postar videos',
            'enviar mensagens',
            'dar likes'
        ]);

        // Atribuir permissões para cliente
        $cliente->givePermissionTo([
            'visualizar anuncios',
            'enviar mensagens',
            'dar likes'
        ]);
    }
} 