<!-- edit-profile.blade.php -->
<div class="w-full bg-white px-4 sm:px-6 lg:px-8" style="min-height: 80vh">
    <div id="delete-modal" tabindex="-1" aria-hidden="true"
        class=" hidden fixed inset-0 z-50 overflow-auto flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
        <!-- Tubuh Modal -->
        <div class="relative bg-white rounded-3xl shadow-lg w-full max-w-md m-2">
            <!-- Header Modal -->
            <div class="flex items-center justify-between p-6 border-b pb-4">
                <h3 class="text-xl font-semibold text-gray-900 ">Delete Account</h3>
                <button type="button" data-modal-hide="delete-modal"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Tubuh Modal -->
            <div class="p-7 space-y-4">
                <p class="text-base leading-relaxed text-gray-500">
                    Are you sure you want to delete your account? This action cannot be undone.
                </p>
            </div>
            <!-- Footer Modal -->
            <div class="flex items-center justify-end p-6 border-t">
                <button wire:click="deleteAccount" type="button"
                    class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm px-6 py-2">Delete
                    Account</button>
                <button type="button" data-modal-cancel="delete-modal"
                    class="ml-2 text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-6 py-2">Cancel</button>
            </div>
        </div>
    </div>

    <div class="w-full max-w-[85rem] py-4 px-4 sm:px-6 lg:px-8 mx-auto bg-white">

        <section class="max-w-[85rem] bg-white dark:bg-gray-800 ">
            <a href="/" class="block mt-4 text-blue-500 hover:text-blue-700">&larr; Back</a>
            <div class="w-full py-4 mx-auto md:px-0 lg:py-6">

                <div class="w-full flex flex-wrap m-auto">
                    <div class="w-full md:w-3/5 md:pr-4 lg:pr-20">
                        <div class=" ">
                            <form wire:submit.prevent="updateProfile" wire:submit="$refresh" class="mb-8">
                                <h2 class="max-w-xl mb-6 text-2xl font-bold dark:text-gray-400 md:text-4xl">Edit Profile
                                </h2>
                                <!-- Tambahkan input untuk nama pengguna -->
                                <div class="mb-6">
                                    <label for="name"
                                        class="block mb-2 text-md font-semibold text-gray-700 dark:text-gray-400">Name</label>
                                    <input type="text" id="name" wire:model.lazy="name"
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-xl focus:outline-none focus:border-blue-500 dark:focus:border-blue-500"
                                        value="{{ $user->name }}">
                                    @error('user.name')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Tambahkan input untuk email pengguna -->
                                <div class="mb-6">
                                    <label for="email"
                                        class="block mb-2 text-md font-semibold text-gray-700 dark:text-gray-400">Email</label>
                                    <input type="text" id="email" wire:model.lazy="user.email"
                                        class="w-full px-4 py-2 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 cursor-not-allowed block disabled"
                                        value="{{ $user->email }}" aria-label="disabled email" disabled>
                                    @error('user.email')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Tombol untuk menyimpan perubahan -->
                                <div class="text-right">
                                    <button type="submit"
                                        class="w-full px-4 py-2 mb-4 bg-blue-500 text-white rounded-full hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Save
                                        Changes</button>
                                    <a href="{{ route('change-password') }}"
                                        class="text-blue-500 hover:text-blue-700">Change
                                        Password</a>
                                </div>
                                @if (session()->has('message'))
                                    <div id="success-alert"
                                        class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-2 relative rounded-xl"
                                        role="alert">
                                        <strong class="font-bold">Success!</strong>
                                        <span class="block sm:inline">{{ session('message') }}</span>
                                    </div>
                                    <script>
                                        setTimeout(function() {
                                            var successAlert = document.getElementById('success-alert');
                                            successAlert.style.display = 'none';
                                        }, 4000); // 4 detik
                                    </script>
                                @endif

                                <!-- Pesan Kesalahan -->
                                @if ($errors->any())
                                    <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative"
                                        role="alert">
                                        <strong class="font-bold">Oops!</strong>
                                        <span class="block sm:inline">There were some problems with your input.</span>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="w-full md:w-2/5 flex justify-center items-center px-0 md:pl-4 lg:pl-8">
                        <div class="bg-red-100 border border-red-400 text-red-700 rounded-3xl p-6 pb-6">
                            <h3 class="text-lg font-semibold mb-2">Delete Account</h3>
                            <p>Are you sure you want to delete your account? This action cannot be undone.</p>
                            <button data-modal-target="delete-modal"
                                class="block text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm px-5 mt-2 -ml-1 py-2 text-center">Delete
                                Account</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteModal = document.getElementById('delete-modal');
        const deleteModalButton = document.querySelector('[data-modal-target="delete-modal"]');
        const closeModalButtons = document.querySelectorAll('[data-modal-hide="delete-modal"]');
        const cancelModalButton = document.querySelector('[data-modal-cancel="delete-modal"]');

        // Fungsi untuk menampilkan modal
        function openModal() {
            deleteModal.classList.remove('hidden');
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            deleteModal.classList.add('hidden');
        }

        // Tambahkan event listener untuk tombol "Delete Account"
        deleteModalButton.addEventListener('click', openModal);

        // Tambahkan event listener untuk semua tombol close modal
        closeModalButtons.forEach(button => {
            button.addEventListener('click', closeModal);
        });

        // Tambahkan event listener untuk tombol "Cancel"
        cancelModalButton.addEventListener('click', closeModal);

        // Tambahkan event listener untuk menutup modal ketika user menekan tombol "Escape"
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !deleteModal.classList.contains('hidden')) {
                closeModal();
            }
        });
    });
</script>
