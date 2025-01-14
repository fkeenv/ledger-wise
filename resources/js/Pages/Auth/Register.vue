<script setup lang="ts">
import { ref } from 'vue'
import { useForm } from 'vee-validate'
import { Head, router } from '@inertiajs/vue3'
import { FormField } from '@/Components/ui/form'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import Input from '@/Components/ui/input/Input.vue'
import Button from '@/Components/ui/button/Button.vue'
import FormItem from '@/Components/ui/form/FormItem.vue'
import Stepper from '@/Components/ui/stepper/Stepper.vue'
import FormLabel from '@/Components/ui/form/FormLabel.vue'
import FormControl from '@/Components/ui/form/FormControl.vue'
import FormMessage from '@/Components/ui/form/FormMessage.vue'
import { CheckIcon, CircleIcon, DotIcon } from 'lucide-vue-next'
import StepperItem from '@/Components/ui/stepper/StepperItem.vue'
import StepperTitle from '@/Components/ui/stepper/StepperTitle.vue'
import FormDescription from '@/Components/ui/form/FormDescription.vue'
import StepperTrigger from '@/Components/ui/stepper/StepperTrigger.vue'
import StepperSeparator from '@/Components/ui/stepper/StepperSeparator.vue'
import StepperDescription from '@/Components/ui/stepper/StepperDescription.vue'

const { handleSubmit, setErrors } = useForm()

const submit = handleSubmit(values => {
  console.log(values)
  router.post('/register', values, {
    onError: errors => {
      console.log(errors)
      setErrors(errors)
    }
  })
})

const stepIndex = ref(1)
const steps = [
  {
    step: 1,
    title: 'Your details',
    description: 'Provide your name and email for your account',
  },
  {
    step: 2,
    title: 'Your site',
    description: 'Provide the subdomain for your site',
  }
]
</script>

<template>
  <GuestLayout>
    <Head title="Register" />

    <Stepper
      v-slot="{ isNextDisabled, isPrevDisabled, nextStep, prevStep }"
      v-model="stepIndex"
      class="block w-full space-y-6"
    >
      <form
        class="w-full space-y-2"
        @submit.prevent="submit"
      >
        <div class="flex w-full flex-start gap-2">
          <StepperItem
            v-for="step in steps"
            :key="step.step"
            v-slot="{ state }"
            class="relative flex w-full flex-col items-center justify-center"
            :step="step.step"
          >
            <StepperSeparator
              v-if="step.step !== steps[steps.length - 1].step"
              class="absolute left-[calc(50%+20px)] right-[calc(-50%+10px)] top-5 block h-0.5 shrink-0 rounded-full bg-muted group-data-[state=completed]:bg-primary"
            />

            <StepperTrigger as-child>
              <Button
                :variant="state === 'completed' || state === 'active' ? 'default' : 'outline'"
                size="icon"
                class="z-10 rounded-full shrink-0"
                :class="[state === 'active' && 'ring-2 ring-ring ring-offset-2 ring-offset-background']"
                :disabled="state !== 'completed'"
              >
                <CheckIcon
                  v-if="state === 'completed'"
                  class="size-5"
                />
                <CircleIcon v-if="state === 'active'" />
                <DotIcon v-if="state === 'inactive'" />
              </Button>
            </StepperTrigger>

            <div class="mt-5 flex flex-col items-center text-center">
              <StepperTitle
                :class="[state === 'active' && 'text-primary']"
                class="text-sm font-semibold transition lg:text-base"
              >
                {{ step.title }}
              </StepperTitle>
              <StepperDescription
                :class="[state === 'active' && 'text-primary']"
                class="sr-only text-xs text-muted-foreground transition md:not-sr-only lg:text-sm"
              >
                {{ step.description }}
              </StepperDescription>
            </div>
          </StepperItem>
        </div>

        <div
          v-show="stepIndex === 1"
          class="w-full space-y-2"
        >
          <FormField
            v-slot="{ componentField }"
            name="name"
          >
            <FormItem>
              <FormLabel>Name</FormLabel>
              <FormControl>
                <Input
                  type="text"
                  placeholder="Display Name"
                  v-bind="componentField"
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>

          <FormField
            v-slot="{ componentField }"
            name="email"
          >
            <FormItem>
              <FormLabel>Email</FormLabel>
              <FormControl>
                <Input
                  type="email"
                  placeholder="Email Address"
                  v-bind="componentField"
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>

          <FormField
            v-slot="{ componentField }"
            name="password"
          >
            <FormItem>
              <FormLabel>Password</FormLabel>
              <FormControl>
                <Input
                  type="password"
                  placeholder="Password"
                  v-bind="componentField"
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>

          <FormField
            v-slot="{ componentField }"
            name="password_confirmation"
          >
            <FormItem>
              <FormLabel>Confirm Password</FormLabel>
              <FormControl>
                <Input
                  type="password"
                  placeholder="Confirm Password"
                  v-bind="componentField"
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>
        </div>

        <div
          v-show="stepIndex === 2"
          class="w-full space-y-2"
        >
          <FormField
            v-slot="{ componentField }"
            name="site_name"
          >
            <FormItem>
              <FormLabel>Site Name</FormLabel>
              <FormControl>
                <Input
                  type="text"
                  placeholder="Site Name"
                  v-bind="componentField"
                />
                <FormDescription>
                  Your site will be available at <strong>{{ componentField.modelValue }}.ledger-wise.test</strong>
                </FormDescription>
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>
        </div>

        <div class="flex items-center justify-between mt-4">
          <Button
            :disabled="isPrevDisabled"
            variant="outline"
            size="sm"
            @click="prevStep()"
          >
            Back
          </Button>
          <div class="flex items-center gap-3">
            <Button
              v-if="stepIndex === 1"
              type="button"
              size="sm"
              @click="nextStep()"
            >
              Next
            </Button>
            <Button
              v-if="stepIndex === 2"
              size="sm"
              type="submit"
            >
              Submit
            </Button>
          </div>
        </div>
      </form>
    </Stepper>
  </GuestLayout>
</template>
