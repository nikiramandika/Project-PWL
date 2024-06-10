<!-- change-password.blade.php -->

<div class="w-full  py-10 px-4 sm:px-6 lg:px-8 mx-auto bg-white">
    <section class="overflow-hidden bg-white dark:bg-gray-800 px-4 sm:px-6 lg:px-8 max-w-[85rem]">
        
        <div class="max-w-[85rem] py-2 mx-auto lg:py-2 ">
            <a href="/profile" class="block text-blue-500 hover:text-blue-700">&larr; Back</a>
            <div class="w-full flex flex-wrap">
                <div class="w-full md:w-1/3 m-auto">
                    <div class="mt-4 m-auto">
                        <form wire:submit.prevent="changePassword" class="mb-8">
                            <h2 class="max-w-[85rem] mb-6 text-2xl font-bold dark:text-gray-400 md:text-4xl rounded-full">Change Password
                            </h2>
                            <!-- Tambahkan input untuk password lama -->
                            <div class="mb-6">
                                <label for="current_password"
                                    class="block mb-2 text-md font-semibold text-gray-700 dark:text-gray-400 ">Current
                                    Password</label>
                                <input type="password" id="current_password" wire:model.lazy="current_password"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:border-blue-500 dark:focus:border-blue-500 rounded-xl">
                                @error('current_password')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Tambahkan input untuk password baru -->
                            <div class="mb-6">
                                <label for="password"
                                    class="block mb-2 text-md font-semibold text-gray-700 dark:text-gray-400">New
                                    Password</label>
                                <input type="password" id="password" wire:model.lazy="password"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700  focus:outline-none focus:border-blue-500 dark:focus:border-blue-500 rounded-xl">
                                @error('password')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Tambahkan input untuk konfirmasi password baru -->
                            <div class="mb-6">
                                <label for="password_confirmation"
                                    class="block mb-2 text-md font-semibold text-gray-700 dark:text-gray-400">Confirm
                                    New Password</label>
                                <input type="password" id="password_confirmation"
                                    wire:model.lazy="password_confirmation"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700  focus:outline-none focus:border-blue-500 dark:focus:border-blue-500 rounded-xl">
                            </div>
                            <!-- Tombol untuk menyimpan perubahan -->
                            <div>
                                <button type="submit"
                                    class="w-full px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:bg-blue-600 rounded-full">Change
                                    Password</button>
                            </div>
                            @if (session()->has('success_message'))
                                <div id="success-alert" class="mt-4 px-4 py-2 rounded relative bg-green-100 border border-green-400 text-green-700">
                                    <strong class="font-bold">Success!</strong>
                                    <span class="block sm:inline">{{ session('success_message') }}</span>
                                </div>
                                <script>
                                    setTimeout(function() {
                                        var successAlert = document.getElementById('success-alert');
                                        successAlert.style.display = 'none';
                                    }, 4000); // 4 detik
                                </script>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
