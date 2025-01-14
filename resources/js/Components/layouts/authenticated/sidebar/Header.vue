<template>
  <SidebarHeader>
    <SidebarMenu>
      <SidebarMenuItem>
        <div class="flex flex-1 items-center gap-4 px-2 py-1">
          <div
            class="flex aspect-square size-8 items-center justify-center rounded-lg bg-sidebar-primary text-sidebar-primary-foreground"
          >
            <ApplicationLogo
              class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"
            />
          </div>
          <div class="grid flex-1 text-left text-sm leading-tight">
            <span class="truncate font-semibold">LedgerWise</span>
            <span class="truncate text-xs">Site Admin</span>
          </div>
        </div>
      </SidebarMenuItem>
    </SidebarMenu>
  </SidebarHeader>
</template>

<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import SidebarMenu from '@/Components/ui/sidebar/SidebarMenu.vue'
import SidebarHeader from '@/Components/ui/sidebar/SidebarHeader.vue'
import SidebarMenuItem from '@/Components/ui/sidebar/SidebarMenuItem.vue'
</script>
