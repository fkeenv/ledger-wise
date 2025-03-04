// @ts-check
import withNuxt from './.nuxt/eslint.config.mjs'

export default withNuxt(
  // Your custom configs here
  {
    rules: {
      'vue/multi-word-component-names': 'off',
      'vue/singleline-html-element-content-newline': 'error',
      'vue/multiline-html-element-content-newline': 'error',
      'no-undef': 'off',
      'indent': ['error', 2],
      'semi': ['error', 'never'],
      'vue/no-v-html': 'off',
      '@typescript-eslint/no-explicit-any': 'off',
    },
  },
)
