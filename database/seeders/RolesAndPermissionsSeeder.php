<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // User
            'user.view', 'user.create', 'user.edit', 'user.delete',
            'user.ban', 'user.unban', 'user.assign-role', 'user.remove-role',
            //role
            'role.view', 'role.create', 'role.edit', 'role.delete',

            // Post
            'post.view', 'post.create', 'post.edit', 'post.delete',
            'post.publish', 'post.unpublish', 'post.feature',

            // Category & Tag
            'category.view','category.create', 'category.edit', 'category.delete',
            'tag.create', 'tag.edit', 'tag.delete',


            // Media
            'media.upload', 'media.delete', 'media.access',

            // Comment
            'comment.view', 'comment.approve', 'comment.delete', 'comment.reply',

            // Ads
            'ad.create', 'ad.edit', 'ad.delete', 'ad.approve',
            'ad.reject', 'ad.pause', 'ad.view-stats',

            // Marketing & Sponsorship
            'sponsorship.create', 'sponsorship.edit', 'sponsorship.delete',
            'sponsorship.approve', 'marketing.campaign.create',
            'marketing.analytics.view', 'affiliate.manage',

            // System
            'settings.view', 'settings.update',
            'seo.manage', 'dashboard.access', 'analytics.view',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        $roles = [
            'superadmin', 'admin', 'editor', 'writer', 'contributor',
            'moderator', 'adsmanager', 'marketingmanager',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        Role::findByName('superadmin')->syncPermissions(Permission::all());

        Role::findByName('admin')->syncPermissions([
            'user.view', 'user.create', 'user.edit', 'user.delete',
            'user.ban', 'user.unban', 'user.assign-role', 'user.remove-role',
            'post.view', 'post.create', 'post.edit', 'post.delete',
            'post.publish', 'post.unpublish', 'post.feature',
            'category.create', 'category.edit', 'category.delete',
            'tag.create', 'tag.edit', 'tag.delete',
            'media.upload', 'media.delete', 'media.access',
            'comment.view', 'comment.approve', 'comment.delete',
            'settings.view', 'settings.update',
            'seo.manage', 'dashboard.access', 'analytics.view',
            'ad.create', 'ad.edit', 'ad.delete', 'ad.approve',
            'ad.reject', 'ad.pause', 'ad.view-stats',
            'sponsorship.create', 'sponsorship.edit', 'sponsorship.delete',
            'sponsorship.approve', 'marketing.campaign.create',
            'marketing.analytics.view', 'affiliate.manage',
        ]);

        Role::findByName('editor')->syncPermissions([
            'post.view', 'post.edit', 'post.publish', 'post.unpublish', 'post.feature',
            'comment.view', 'comment.approve', 'comment.delete',
            'media.upload', 'media.access', 'dashboard.access',
        ]);

        Role::findByName('writer')->syncPermissions([
            'post.view', 'post.create', 'post.edit', 'media.upload', 'media.access',
        ]);

        Role::findByName('contributor')->syncPermissions([
            'post.create',
        ]);

        Role::findByName('moderator')->syncPermissions([
            'comment.view', 'comment.approve', 'comment.delete',
        ]);

        Role::findByName('adsmanager')->syncPermissions([
            'ad.create', 'ad.edit', 'ad.delete', 'ad.approve',
            'ad.reject', 'ad.pause', 'ad.view-stats',
            'sponsorship.create', 'sponsorship.edit', 'sponsorship.delete',
            'sponsorship.approve', 'marketing.analytics.view',
        ]);

        Role::findByName('marketingmanager')->syncPermissions([
            'marketing.campaign.create', 'marketing.analytics.view',
            'affiliate.manage', 'seo.manage',
        ]);
    }
}
