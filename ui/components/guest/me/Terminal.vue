<template>
  <Card
    class="bg-white/90 text-black dark:bg-black dark:text-white rounded-lg p-4 shadow-md"
    @click="focusInput"
  >
    <CardHeader class="pb-4">
      <CardTitle>Terminal</CardTitle>
      <CardDescription>Enter "help" to learn more.</CardDescription>
    </CardHeader>
    <CardContent class="overflow-y-auto h-[400px]">
      <div class="space-y-2">
        <div
          v-for="(line, index) in history"
          :key="index"
        >
          <span class="text-green-400">{{ line.command }}</span>
          <div
            v-if="line.output"
            class="pl-4"
          >
            <span
              :class="{ 'text-blue-600': line.link }"
              v-html="line.output"
            />
          </div>
        </div>
        <div class="flex items-center">
          <span class="text-green-400">~</span>
          <input
            ref="input"
            v-model="command"
            type="text"
            class="bg-transparent border-none outline-none flex-grow ml-2 text-amber-400"
            @keyup.enter="executeCommand"
          >
        </div>
      </div>
    </CardContent>
  </Card>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'

const command = ref('')
const history = ref<{ command: string, output?: string, link?: string }[]>([])
const input = ref<HTMLInputElement | null>(null)

const executeCommand = () => {
  const cmd = command.value.trim().toLowerCase()
  let output = ''

  switch (cmd) {
  case 'keen projects':
    output = `
        previous projects worked on: <br />
        - (SaaS) School Management System <br />
        - Inventory Management System <br />
        - Statement of Account, and Online Application platform for a cooperative financial institution <br />
        - Multi-level Marketing (MLM) System <br />
        <br />
        side projects: <br />
        - <a href="https://github.com/fkeenv/ledger-wise" target="_blank" class="text-indigo-500 underline">(SaaS) All-in-one HRiS, Accounting, etc. System</a> <br />
        - Business to Business (B2B) Booking platform for a local travel agency <br />
        <br />
        technologies used: <br />
        - Laravel <br />
        - Vue.js <br />
        - Tailwind CSS <br />
        - Inertia.js <br />
        - MySQL <br />
        <br />
        servers: <br />
        - AWS <br />
        - DigitalOcean <br />
      `
    break
  case 'keen contacts':
    output = `
        Contacts: <br />
        - Email: <a href="mailto:keenvergara@gmail.com" class="text-indigo-500 underline">keenvergara@gmail.com</a> <br />
        - <a href="https://www.linkedin.com/in/fharylle-keen-vergara-98a170122/" target="_blank" class="text-indigo-500 underline">LinkedIn</a> <br />
        - Skype: keen_vergara / keenvergara@hotmail.com <br />
        - Github: <a href="https://github.com/fkeenv" target="_blank" class="text-indigo-500 underline">fkeenv</a> <br />
      `
    break
  case 'keen about':
    output = `
        I'm Keen, a software developer with almost 5 years of experience. The tech stack I have consistently been working on is Laravel, VueJS, and MySQL. Over the course of my career, I have worked on several projects i.e. School Management System, Inventory ERP, Balances Viewing as well as an application forms app for a local cooperative bank, and a couple of side projects. I'm currently looking for a company to settle in and be able to be of service to the company to the best of my skills and abilities. Check out "keen projects" to know more about the projects I've worked on. <br /> <br />

        I'm also open to freelance work. If you have a project that you'd like to work with me on, feel free to reach out to me. Check out "keen contacts" to know how to contact me. I'm looking forward to touch base with you! :) <br />
      `
    break
  case 'help':
    output = `
        Known commands: <br/>
        <span class="text-amber-400">keen projects</span> ----- details of Keen's profile <br/>
        <span class="text-amber-400">keen contacts</span> ----- known ways on how to contact this developer <br />
        <span class="text-amber-400">keen about</span> ----- a brief description of Keen
      `
    break
  case 'clear':
    history.value = []
    command.value = ''
    return
  default:
    output = `${cmd} is not a recognized command. Try "keen projects", "keen contacts", or "keen about".`
  }

  history.value.push({ command: command.value, output })
  command.value = ''

  // Scroll to bottom of terminal
  setTimeout(() => {
    if (input.value) {
      input.value.scrollIntoView({ behavior: 'smooth', block: 'end' })
    }
  }, 0)
}

const focusInput = () => {
  if (input.value) {
    input.value.focus()
  }
}

onMounted(() => {
  if (input.value) {
    input.value.focus()
  }
})
</script>
