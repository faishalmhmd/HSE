<x-app-layout>
    <x-sidebar />

    <div class="w-full p-5">
        <div class="bg-white dark:bg-zinc-900 dark:border-zinc-700 p-4 border overflow-x-auto rounded-xl">
            <div class="p-5" x-data="paginationHandler()" x-init="init();">
                <div class="mb-10">
                    <div class="grid grid-cols-8 gap-5">
                        <div
                            class="px-5 py-4  font-semibold border-gray-300 dark:border-zinc-500 border rounded-lg text-black dark:text-white">
                            <span class="flex items-center justify-between text-zinc-600 dark:text-white">
                                Karyawan Aktif
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                        stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                                        stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                            <p class="font-bold text-2xl">24</p>
                        </div>
                        <div
                            class="px-5 py-4  font-semibold border-gray-300 dark:border-zinc-500 border rounded-lg text-black dark:text-white">
                            <span class="flex items-center justify-between text-zinc-600 dark:text-white">
                                Karyawan Non-Aktif
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                    viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                        stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                                        stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                            <p class="font-bold text-2xl">24</p>
                        </div>
                    </div>
                </div>
                <!-- Add Karyawan -->
                <div class="flex ">
                    <div class="text-2xl font-bold mb-4 mr-auto text-black dark:text-white">Data Karyawan</div>
                    <!-- search Karyawan-->
                    <div class="relative mb-6">
                        <div
                            class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-zinc-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" height="20"
                                viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M11 6C13.7614 6 16 8.23858 16 11M16.6588 16.6549L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        {{-- <input type="text" placeholder="Search..."  class="border border-zinc-300 p-2 mb-4 w-full" /> --}}
                        <input type="text" id="input-group-1"
                            class="border border-zinc-300 text-zinc-900 text-lg rounded-lg focus:ring-zinc-500 focus:border-zinc-500 block w-full ps-10 p-2 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-zinc-300 dark:focus:border-zinc-300 pl-12"
                            placeholder="Cari Karyawan" x-model="searchQuery" @input="filterEmployees">
                    </div>
                    <!-- add Karyawan-->
                    <a href="{{ route('add-karyawan') }}" class="mx-4">
                        <div
                            class="text-lg text-white font-bold mb-4 flex items-center bg-zinc-400 hover:bg-zinc-500 transition duration-150 ease-in-out p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M20 18L17 18M17 18L14 18M17 18V15M17 18V21M11 21H4C4 17.134 7.13401 14 11 14C11.695 14 12.3663 14.1013 13 14.2899M15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z"
                                    stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Tambah Karyawan
                        </div>
                    </a>
                    <!-- export Karyawan-->
                    <a href="{{ route('pdf-data-karyawan') }}">
                        <div
                            class="text-lg text-white font-bold mb-4 flex items-center bg-zinc-400 hover:bg-zinc-500 transition duration-150 ease-in-out p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M9 17H15M9 13H15M9 9H10M13 3H8.2C7.0799 3 6.51984 3 6.09202 3.21799C5.71569 3.40973 5.40973 3.71569 5.21799 4.09202C5 4.51984 5 5.0799 5 6.2V17.8C5 18.9201 5 19.4802 5.21799 19.908C5.40973 20.2843 5.71569 20.5903 6.09202 20.782C6.51984 21 7.0799 21 8.2 21H15.8C16.9201 21 17.4802 21 17.908 20.782C18.2843 20.5903 18.5903 20.2843 18.782 19.908C19 19.4802 19 18.9201 19 17.8V9M13 3L19 9M13 3V7.4C13 7.96005 13 8.24008 13.109 8.45399C13.2049 8.64215 13.3578 8.79513 13.546 8.89101C13.7599 9 14.0399 9 14.6 9H19"
                                    stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Export Data Karyawan
                        </div>
                    </a>
                </div>

                <table class="min-w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-zinc-700 text-black dark:text-white ">
                            <template x-for="(column, index) in columns" :key="index">
                                <th class="border border-zinc-200 dark:border-zinc-500 px-4 py-2 text-left cursor-pointer"
                                    :style="{ width: column.width }" @click="sortTable(column.field)">
                                    <span x-text="column.label"></span>
                                    <span x-show="sortField === column.field"
                                        x-text="sortDirection === 'asc' ? '▲' : '▼'"></span>
                                </th>
                            </template>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(employee, index) in filteredEmployees" :key="employee.id">
                            <tr>
                                <template x-for="(column, index) in columns" :key="index">
                                    <td class="border border-zinc-200 dark:border-zinc-500 px-4 py-2 text-black dark:text-white"
                                        :style="{ width: column.width }">
                                        <template x-if="column.field === 'actions'">
                                            <div class="flex space-x-2">
                                                <a :href="`/karyawan/${employee.id}/edit`"
                                                    class="bg-zinc-500 py-2 px-5 rounded-lg font-bold text-white hover:bg-zinc-600 transition duration-150 ease-in-ou">
                                                    Edit
                                                </a>
                                                <button @click="deleteEmployee(employee.id)"
                                                    class="bg-zinc-500 py-2 px-5 rounded-lg font-bold text-white">Delete</button>
                                            </div>
                                        </template>
                                        <template x-if="column.field === 'status'">
                                            <span
                                                :class="{
                                                    'bg-zinc-700 text-white rounded-lg border border-zinc-900 dark:border-zinc-600': employee[
                                                        column
                                                        .field] === 'active',
                                                    'bg-zinc-300 rounded-lg border border-zinc-400 text-zinc-700': employee[
                                                        column
                                                        .field] !== 'active'
                                                }"
                                                class="rounded-lg font-bold py-1 px-2"
                                                x-text="employee[column.field]"></span>
                                        </template>
                                        <template x-if="column.field !== 'actions' && column.field !== 'status'">
                                            <span x-text="employee[column.field]"></span>
                                        </template>

                                    </td>
                                </template>
                            </tr>
                        </template>
                    </tbody>
                </table>

                <div class="mt-4">
                    <button class="px-4 py-2 bg-gray-300 rounded" :disabled="!pagination.prev_page_url"
                        @click="fetchData(pagination.prev_page_url)">
                        Previous
                    </button>
                    <button class="px-4 py-2 bg-gray-300 rounded" :disabled="!pagination.next_page_url"
                        @click="fetchData(pagination.next_page_url)">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/administrator/karyawan.index.js') }}"></script>
</x-app-layout>
