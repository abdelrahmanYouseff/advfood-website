import { useI18n } from 'vue-i18n'

/**
 * Composable for displaying product name/description based on current locale.
 * Default language is Arabic - shows name_ar/description_ar when available.
 */
export function useProductLocale() {
  const { locale } = useI18n()

  const getProductName = (product: { name?: string; name_ar?: string | null }) => {
    if (!product) return ''
    const currentLocale = locale.value || 'ar'
    if (currentLocale === 'ar' && product.name_ar) {
      return product.name_ar
    }
    return product.name || ''
  }

  const getProductDescription = (product: { description?: string | null; description_ar?: string | null }) => {
    if (!product) return ''
    const currentLocale = locale.value || 'ar'
    if (currentLocale === 'ar' && product.description_ar) {
      return product.description_ar
    }
    return product.description || ''
  }

  return { getProductName, getProductDescription }
}
