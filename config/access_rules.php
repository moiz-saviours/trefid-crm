<?php
return [
    'sales' => [
        'routes' => [
            'user.dashboard',
            'customer.company.index',
            'customer.contact.index',
            'customer.contact.store',
            'customer.contact.edit',
            'customer.contact.update',
            'team-member.index',
            'brand.index',
            'lead.index',
            'lead.change.lead-status',
            'lead-status.index',
            'invoice.index',
            'invoice.store',
            'invoice.edit',
            'invoice.update',
            'user.client.account.by.brand',
            'payment.index',
            'payment-transaction-logs',
            'save.settings',
        ],
    ],
    'development' => [
        'routes' => [
            'project-management.*', // Project management system routes
        ],
    ],
    'marketing' => [
        'routes' => [
            'user.dashboard', // Marketing dashboard
            'marketing-campaigns.*', // Marketing campaigns
        ],
    ],
    'humanresources' => [
        'routes' => [
            'employee-management.*', // Employee management routes
        ],
    ],
    'operations' => [
        'roles' => [
            'Q/A Analyst' => [
                'routes' => [
                    'payments.check', // Check payments
                    'payments.approve', // Approve payments
                    'payments.disapprove', // Disapprove payments
                ],
            ],
            'Accounts' => [
                'routes' => [
                    'user.dashboard',
                    'user.client.contact.index',
                    'user.client.contact.edit',
                    'user.client.contact.update',
                    'user.client.contact.change.status',
                    'user.client.company.index',
                    'user.client.contact.companies',
                    'user.client.company.edit',
                    'user.client.company.update',
                    'user.client.company.change.status',
                    'user.client.account.index',
                    'user.client.account.edit',
                    'user.client.account.update',
                    'user.client.account.change.status',
                    'payment.index',
                    'payment-transaction-logs',
                    'save.settings',
                ],
                'restrictions' => [
                    'merchants.edit-login', // Cannot edit login details
                    'merchants.edit-transaction-key', // Cannot edit transaction keys
                ],
            ],
        ],
    ],
];
