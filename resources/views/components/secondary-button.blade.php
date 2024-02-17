<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-gray-300 rounded-md font-semibold text-xs text-gray-200 hover:text-black uppercase tracking-widest shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
