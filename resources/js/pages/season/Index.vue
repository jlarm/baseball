<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { DropdownMenu, DropdownMenuTrigger, DropdownMenuContent, DropdownMenuItem  } from '@/components/ui/dropdown-menu';
import { Button } from '@/components/ui/button';
import { Ellipsis } from "lucide-vue-next"

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Seasons',
        href: '/seasons',
    }
]
</script>

<template>
    <Head title="Seasons" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container max-w-xl mx-auto mt-6">
            <Table>
                <TableBody>
                    <TableRow>
                        <TableCell>Fall 2025</TableCell>
                        <TableCell class="text-right">
                            <DropdownMenu>
                                <DropdownMenuTrigger>
                                    <Button variant="ghost" size="icon">
                                        <Ellipsis class="w-4 h-4" />
                                    </Button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent>
                                    <DropdownMenuItem>View</DropdownMenuItem>
                                    <DropdownMenuItem>Archive</DropdownMenuItem>
                                </DropdownMenuContent>
                            </DropdownMenu>
                        </TableCell>
                    </TableRow>
                    <TableRow>
                        <TableCell>Summer 2026</TableCell>
                        <TableCell class="text-right">
                            <DropdownMenu>
                                <DropdownMenuTrigger>
                                    <Button variant="ghost" size="icon">
                                        <Ellipsis class="w-4 h-4" />
                                    </Button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent>
                                    <DropdownMenuItem>View</DropdownMenuItem>
                                    <DropdownMenuItem>Archive</DropdownMenuItem>
                                </DropdownMenuContent>
                            </DropdownMenu>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>
