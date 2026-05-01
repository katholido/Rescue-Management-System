@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white dark:bg-slate-800 border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white focus:border-red-500 dark:focus:border-red-500 focus:ring-red-500 dark:focus:ring-red-500 rounded-xl shadow-sm transition-colors']) }}>
