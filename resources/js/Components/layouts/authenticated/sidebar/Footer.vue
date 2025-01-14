<script setup lang="ts">
import Avatar from '@/Components/ui/avatar/Avatar.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import AvatarImage from '@/Components/ui/avatar/AvatarImage.vue'
import SidebarMenu from '@/Components/ui/sidebar/SidebarMenu.vue'
import SidebarFooter from '@/Components/ui/sidebar/SidebarFooter.vue'
import AvatarFallback from '@/Components/ui/avatar/AvatarFallback.vue'
import SidebarMenuItem from '@/Components/ui/sidebar/SidebarMenuItem.vue'
import DropdownMenu from '@/Components/ui/dropdown-menu/DropdownMenu.vue'
import SidebarMenuButton from '@/Components/ui/sidebar/SidebarMenuButton.vue'
import DropdownMenuItem from '@/Components/ui/dropdown-menu/DropdownMenuItem.vue'
import DropdownMenuLabel from '@/Components/ui/dropdown-menu/DropdownMenuLabel.vue'
import DropdownMenuGroup from '@/Components/ui/dropdown-menu/DropdownMenuGroup.vue'
import {
  BadgeCheck,
  Bell,
  ChevronsUpDown,
  LogOut,
} from 'lucide-vue-next'
import DropdownMenuContent from '@/Components/ui/dropdown-menu/DropdownMenuContent.vue'
import DropdownMenuTrigger from '@/Components/ui/dropdown-menu/DropdownMenuTrigger.vue'
import DropdownMenuSeparator from '@/Components/ui/dropdown-menu/DropdownMenuSeparator.vue'
</script>

<template>
  <SidebarFooter>
    <SidebarMenu>
      <SidebarMenuItem>
        <DropdownMenu>
          <DropdownMenuTrigger as-child>
            <SidebarMenuButton
              size="lg"
              class="data-[state=open]:bg-sidebar-accent data-[state=open]:text-sidebar-accent-foreground"
            >
              <Avatar class="h-8 w-8 rounded-lg">
                <AvatarImage src="https://i.pravatar.cc/300" />
                <AvatarFallback class="rounded-lg">
                  CN
                </AvatarFallback>
              </Avatar>
              <div class="grid flex-1 text-left text-sm leading-tight">
                <span class="truncate font-semibold">{{
                  $page.props.auth.user.name
                }}</span>
                <span class="truncate text-xs">{{
                  $page.props.auth.user.email
                }}</span>
              </div>
              <ChevronsUpDown class="ml-auto size-4" />
            </SidebarMenuButton>
          </DropdownMenuTrigger>
          <DropdownMenuContent
            class="w-[--radix-dropdown-menu-trigger-width] min-w-56 rounded-lg"
            side="bottom"
            align="end"
            :side-offset="4"
          >
            <DropdownMenuLabel class="p-0 font-normal">
              <div
                class="flex items-center gap-2 px-1 py-1.5 text-left text-sm"
              >
                <Avatar class="h-8 w-8 rounded-lg">
                  <AvatarImage
                    src="https://i.pravatar.cc/300"
                    :alt="$page.props.auth.user.name"
                  />
                  <AvatarFallback class="rounded-lg">
                    CN
                  </AvatarFallback>
                </Avatar>
                <div
                  class="grid flex-1 text-left text-sm leading-tight"
                >
                  <span class="truncate font-semibold">{{
                    $page.props.auth.user.name
                  }}</span>
                  <span class="truncate text-xs">{{
                    $page.props.auth.user.email
                  }}</span>
                </div>
              </div>
            </DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuGroup>
              <DropdownMenuItem>
                <BadgeCheck />
                Account
              </DropdownMenuItem>
              <DropdownMenuItem>
                <Bell />
                Notifications
              </DropdownMenuItem>
            </DropdownMenuGroup>
            <DropdownMenuSeparator />
            <DropdownMenuItem>
              <DropdownLink
                :href="route('logout')"
                method="post"
                classes="flex flex-1 items-center gap-2 focus:bg-accent focus:text-accent-foreground cursor-base"
              >
                <LogOut />
                Log out
              </DropdownLink>
            </DropdownMenuItem>
          </DropdownMenuContent>
        </DropdownMenu>
      </SidebarMenuItem>
    </SidebarMenu>
  </SidebarFooter>
</template>
