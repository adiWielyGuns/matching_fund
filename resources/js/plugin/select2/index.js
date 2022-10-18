import Select from './Select2'

const Select2 = {
  install (Vue, options) {
    Vue.component('select2', Select)
  }
}

export default Select2

if (typeof window !== 'undefined' && window.Vue) {
  window.Vue.use(Select2)
}
