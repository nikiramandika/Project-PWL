<!-- change-password.blade.php -->

<div class="w-full py-10 px-4 sm:px-6 lg:px-8 mx-auto bg-white">
    <section class="overflow-hidden bg-white dark:bg-gray-800 px-4 sm:px-6 lg:px-8">
        <a href="/profile" class="block mt-4 text-blue-500 hover:text-blue-700">&larr; Back</a>
        <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">
            <div class="w-full flex flex-wrap -mx-4">
                <div class="w-full px-4 md:w-1/2">
                    <div class="lg:pl-20 md:pl-4">
                        <form wire:submit.prevent="changePassword" class="mb-8">
                            <h2 class="max-w-xl mb-6 text-2xl font-bold dark:text-gray-400 md:text-4xl">Change Password
                            </h2>
                            <!-- Tambahkan input untuk password lama -->
                            <div class="mb-6">
                                <label for="current_password"
                                    class="block mb-2 text-md font-semibold text-gray-700 dark:text-gray-400">Current
                                    Password</label>
                                <input type="password" id="current_password" wire:model.lazy="current_password"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:border-blue-500 dark:focus:border-blue-500">
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
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:border-blue-500 dark:focus:border-blue-500">
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
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:border-blue-500 dark:focus:border-blue-500">
                            </div>
                            <!-- Tombol untuk menyimpan perubahan -->
                            <div>
                                <button type="submit"
                                    class="w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Change
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
