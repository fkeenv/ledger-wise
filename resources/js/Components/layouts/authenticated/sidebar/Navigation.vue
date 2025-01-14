<template>
  <SidebarContent>
    <SidebarGroup
      v-for="navigation in navigations"
      :key="navigation.label"
      class="group-data-[collapsible=icon]:hidden"
    >
      <SidebarGroupLabel>
        {{ navigation.label }}
      </SidebarGroupLabel>
      <SidebarMenu
        v-for="child in navigation.children"
        :key="child.label"
      >
        <SidebarMenuItem>
          <SidebarMenuButton as-child>
            <a href="#">
              <component :is="child.icon" />
              <span>{{ child.label }}</span>
            </a>
          </SidebarMenuButton>
        </SidebarMenuItem>
      </SidebarMenu>
    </SidebarGroup>
  </SidebarContent>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import SidebarMenu from '@/Components/ui/sidebar/SidebarMenu.vue'
import SidebarGroup from '@/Components/ui/sidebar/SidebarGroup.vue'
import SidebarContent from '@/Components/ui/sidebar/SidebarContent.vue'
import SidebarMenuItem from '@/Components/ui/sidebar/SidebarMenuItem.vue'
import SidebarGroupLabel from '@/Components/ui/sidebar/SidebarGroupLabel.vue'
import SidebarMenuButton from '@/Components/ui/sidebar/SidebarMenuButton.vue'
import {
  BarChart2,
  Cog,
  CreditCard,
  HelpCircle,
  Home,
} from 'lucide-vue-next'

const navigations = ref([
  {
    label: 'Main',
    children: [
      {
        key: 'dashboard',
        label: 'Dashboard',
        link: '#',
        icon: Home
      },
      {
        key: 'billing',
        label: 'Billing',
        link: '/billing',
        icon: CreditCard
      },
      {
        key: 'reports',
        label: 'Reports',
        link: '/reports',
        icon: BarChart2
      },
      {
        key: 'support',
        label: 'Support',
        link: '/support',
        icon: HelpCircle
      },
      {
        key: 'settings',
        label: 'Settings',
        link: '#',
        icon: Cog
      }
    ]
  },

])
</script>

<style scoped>

</style>
