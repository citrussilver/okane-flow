import { computed } from 'vue';

export function useNavItemClasses(activeRef) {
  return computed(() =>
    activeRef.value
      ? [
          'inline-flex',                   // Ensures icon + text layout
          'items-center',                 // Vertically center icon
          'justify-center',               // Horizontally center if needed
          'h-[42px]',                     // 👈 Added fixed height for alignment
          'leading-none',                 // 👈 Ensures no baseline shifting
          'px-3',                         // Horizontal padding
          'text-sm',
          'font-medium',
          'text-gray-900 dark:text-white',
          'border-b-2 border-indigo-500',
        ].join(' ')
      : [
          'inline-flex',
          'items-center',
          'justify-center',
          'h-[42px]',                     // 👈 Same fixed height for consistency
          'leading-none',                 // 👈 Prevent text baseline push
          'px-3',
          'text-sm',
          'font-medium',
          'text-gray-500 dark:text-gray-400',
          'hover:text-gray-900 dark:hover:text-white',
          'hover:border-gray-300 dark:hover:border-gray-600',
          'border-b-2 border-transparent',
          'transition-all'
        ].join(' ')
  );
}