<x-app-layout>
    <x-sidebar />
    <div class="w-full p-5">
        <div class="bg-white dark:bg-zinc-900 dark:border-zinc-700 p-4 border overflow-x-auto rounded-xl">
            <div class="p-5" x-data="formHandler()" x-init="init();">
                <div class="font-bold text-2xl mb-2 text-black dark:text-white">
                    Tambah data karyawan
                </div>
                <span class="font-medium text-zinc-500 dark:text-zinc-300">Silahkan tambah data karyawan</span>
                <form class="mt-5" @submit.prevent="submitForm" x-data="{
                    formData: {
                        nama_lengkap: '{{ $karyawan->nama ?? '' }}',
                        email: '{{ $karyawan->email ?? '' }}',
                        tgl_lahir: '{{ $karyawan->tgl_lahir ?? '' }}',
                        tgl_masuk: '{{ $karyawan->tgl_masuk ?? '' }}'
                    },
                    submitForm() {
                        // Handle the form submission here
                        console.log(this.formData);
                    }
                }">
                    <div class="grid gap-6 mb-6 grid-cols-4">
                        <div>
                            <label for="nama"
                                class="block mb-2 text-md font-bold text-zinc-900 dark:text-white">Nama
                                Lengkap</label>
                            <input type="text" id="nama_lengkap"
                                class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-md rounded-lg focus:ring-zinc-300 focus:border-zinc-300 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-zinc-200 dark:focus:border-zinc-500"
                                placeholder="John" x-model="formData.nama_lengkap" required />
                        </div>
                        <div class="mb-6">
                            <label for="email"
                                class="block mb-2 text-md font-bold text-zinc-900 dark:text-white">Email
                                address</label>
                            <input type="email" id="email"
                                class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-md rounded-lg focus:ring-zinc-300 focus:border-zinc-300 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-zinc-200 dark:focus:border-zinc-500"
                                placeholder="john.doe@company.com" x-model="formData.email" required />
                        </div>
                        <div>
                            <label for="tgl_lahir"
                                class="block mb-2 text-md font-bold text-zinc-900 dark:text-white">Tgl Lahir</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-zinc-500 dark:text-zinc-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input datepicker id="tgl_lahir" type="text"
                                    class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-md rounded-lg focus:ring-zinc-300 focus:border-zinc-300 block w-full ps-10 p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-zinc-200 dark:focus:border-zinc-500"
                                    placeholder="Tgl Lahir" x-model="formData.tgl_lahir">
                            </div>
                        </div>
                        <div>
                            <label for="tgl_masuk"
                                class="block mb-2 text-md font-bold text-zinc-900 dark:text-white">Tgl Masuk</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-zinc-500 dark:text-zinc-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input datepicker id="tgl_masuk" type="text"
                                    class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-md rounded-lg focus:ring-zinc-300 focus:border-zinc-300 block w-full ps-10 p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Tgl Masuk" x-model="formData.tgl_masuk">
                            </div>
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function formHandler() {
            return {
                formData: {
                    nama_lengkap: '',
                    email: '',
                    tgl_lahir: '',
                    tgl_masuk: '',
                },
                init() {

                },
                submitForm() {
                    axios.post('/add-data-karyawan', this.formData)
                        .then(response => {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data karyawan berhasil ditambahkan.',
                                icon: 'success',
                                confirmButtonText: 'OK',
                                customClass: {
                                    popup: 'bg-white dark:bg-zinc-900 border border-zinc-700 rounded-lg shadow-lg', // Kelas untuk popup
                                    title: 'text-lg font-bold text-black dark:text-white', // Kelas untuk judul
                                    content: 'text-md text-zinc-900 dark:text-zinc-300', // Kelas untuk konten
                                    confirmButton: 'bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded', // Kelas untuk tombol konfirmasi
                                }
                            }).then(() => {
                                window.location.href = '/karyawan';
                            })
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat menambahkan data karyawan.',
                                icon: 'error',
                                confirmButtonText: 'OK',
                                customClass: {
                                    popup: 'bg-white dark:bg-zinc-900 border border-zinc-700 rounded-lg shadow-lg',
                                    title: 'text-lg font-bold text-black dark:text-white',
                                    content: 'text-md text-zinc-900 dark:text-zinc-300',
                                    confirmButton: 'bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded',
                                }
                            })
                        })
                }
            }
        }
    </script>
</x-app-layout>
