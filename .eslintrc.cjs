module.exports = {
  plugins: [`vue`, `simple-import-sort`, `@tanstack/query`],
  extends: [
    `eslint:recommended`,
    `plugin:vue/vue3-recommended`,
    `plugin:@tanstack/eslint-plugin-query/recommended`,
    `prettier`,
  ],
  rules: {
    'quotes': [`error`, `backtick`],
    'simple-import-sort/exports': `error`,
    'simple-import-sort/imports': `error`,
    'vue/multi-word-component-names': `off`,
    'vue/first-attribute-linebreak': `off`,
    'vue/max-attributes-per-line': [
      `error`,
      {
        singleline: {
          max: 3,
        },
        multiline: {
          max: 1,
        },
      },
    ],
  },
  env: {
    node: true,
  },
}
