<script setup lang="ts">
import { Icon } from '@iconify/vue'
import { useColorMode } from '@vueuse/core'
import { Button } from '@/Components/ui/button'
import Sidebar from '@/Components/ui/sidebar/Sidebar.vue'
import DropdownMenu from '@/Components/ui/dropdown-menu/DropdownMenu.vue'
import SidebarProvider from '@/Components/ui/sidebar/SidebarProvider.vue'
import Footer from '@/Components/layouts/authenticated/sidebar/Footer.vue'
import Header from '@/Components/layouts/authenticated/sidebar/Header.vue'
import DropdownMenuItem from '@/Components/ui/dropdown-menu/DropdownMenuItem.vue'
import Navigation from '@/Components/layouts/authenticated/sidebar/Navigation.vue'
import DropdownMenuContent from '@/Components/ui/dropdown-menu/DropdownMenuContent.vue'
import DropdownMenuTrigger from '@/Components/ui/dropdown-menu/DropdownMenuTrigger.vue'
const mode = useColorMode()
</script>

<template>
  <div>
    <div class="flex min-h-svh w-full bg-gray-100 dark:bg-gray-900">
      <!-- Desktop Navigation Menu -->
      <SidebarProvider>
        <Sidebar>
          <Header />

          <Navigation />

          <Footer />
        </Sidebar>

        <div class="flex min-h-svh flex-1 flex-col">
          <!-- Page Content -->
          <main>
            <!-- Page Heading -->
            <header
              v-if="$slots.header"
              class="flex h-[64px] flex-1 items-center justify-between bg-white px-8 shadow dark:bg-gray-800"
            >
              <div class="max-w-full">
                <slot name="header" />
              </div>

              <DropdownMenu>
                <DropdownMenuTrigger as-child>
                  <Button variant="outline">
                    <Icon
                      icon="radix-icons:moon"
                      class="h-[1.2rem] w-[1.2rem] rotate-0 scale-100 transition-all dark:-rotate-90 dark:scale-0"
                    />
                    <Icon
                      icon="radix-icons:sun"
                      class="absolute h-[1.2rem] w-[1.2rem] rotate-90 scale-0 transition-all dark:rotate-0 dark:scale-100"
                    />
                    <span class="sr-only">Toggle theme</span>
                  </Button>
                </DropdownMenuTrigger>
                <DropdownMenuContent align="end">
                  <DropdownMenuItem @click="mode = 'light'">
                    Light
                  </DropdownMenuItem>
                  <DropdownMenuItem @click="mode = 'dark'">
                    Dark
                  </DropdownMenuItem>
                  <DropdownMenuItem @click="mode = 'auto'">
                    System
                  </DropdownMenuItem>
                </DropdownMenuContent>
              </DropdownMenu>
            </header>

            <slot />
          </main>
        </div>
      </SidebarProvider>
    </div>
  </div>
</template>
