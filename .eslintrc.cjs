/* eslint-env node */
require('@rushstack/eslint-patch/modern-module-resolution')

module.exports = {
  root: true,
  extends: [
    'plugin:vue/vue3-recommended',
    'eslint:recommended',
  ],
  plugins: ['perfectionist'],
  rules: {
    'vue/multi-word-component-names': 'off',
    'no-undef': 'off',
    indent: ['error', 2],
    semi: ['error', 'never'],
    'perfectionist/sort-imports': [
      'error',
      {
        type: 'line-length',
        order: 'asc',
        ignoreCase: true,
        specialCharacters: 'keep',
        internalPattern: ['^~/.+'],
        partitionByComment: false,
        partitionByNewLine: false,
        newlinesBetween: 'always',
        maxLineLength: undefined,
        groups: [
          'type',
          ['builtin', 'external'],
          'internal-type',
          'internal',
          ['parent-type', 'sibling-type', 'index-type'],
          ['parent', 'sibling', 'index'],
          'object',
          'unknown',
        ],
        customGroups: { type: {}, value: {} },
        environment: 'node',
      },
    ],
  },
}
