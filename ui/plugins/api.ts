import type { FetchError, FetchContext, FetchResponse } from 'ofetch'

export default defineNuxtPlugin((nuxtApp) => {
  const config = useRuntimeConfig()

  const $api = $fetch.create({
    baseURL: config.baseUrl ?? 'https://api.nuxt.com',
    onRequest({ options }) {
      options.headers.set('Content-Type', 'application/json')
      if (localStorage.getItem('token')) {
        options.headers.set('Authorization', `Bearer ${localStorage.getItem('token')}`)
      }
    },
    onResponseError(context: FetchContext<any, any> & { response: FetchResponse<any>; }) {
      const error = context.error as FetchError<any>

      if (error.response?.status === 401) {
        nuxtApp.runWithContext(() => navigateTo('/login'))
        return // Explicitly return void.
      }

      return Promise.reject(error)
    },
  })

  return {
    provide: {
      api: $api,
    },
  }
})
