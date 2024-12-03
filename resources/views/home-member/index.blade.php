<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        RIS Rental Information System
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">
    <!-- Ubah latar belakang menjadi lebih terang dan netral -->
    <!-- Profil Gambar User -->
    <!-- Header -->
    <header class="bg-gray-800 p-4 flex items-center justify-between">
        <div class="relative w-1/3">
            <input
                class="pl-10 pr-4 py-2 w-full rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Search" type="text" />
            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
        </div>
        <h1 class="text-white text-lg font-bold">RIS RENTAL INFORMATION SYSTEM</h1>
        <!-- Gambar profil -->
        <img id="profileIcon"
            src="{{ Auth::user()->profile->profile_picture ? asset('storage/' . Auth::user()->profile->profile_picture) : asset('default-avatar.png') }}"
            alt="Profile Picture" class="w-10 h-10 rounded-full cursor-pointer border-2 border-white object-cover">
    </header>

    <!-- Sidebar Profile User -->
    <div id="sidebar"
        class="fixed top-0 right-0 w-1/4 h-full bg-gray-800 p-6 rounded-lg transform translate-x-full transition-all ease-in-out duration-300">
        <h2 class="text-white text-lg mb-4">Profile User</h2>

        @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md mb-4">
            {{ session('success') }}
        </div>
        @endif

        <!-- Form untuk Profile -->
        <form action="{{ route('profile.save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-white mb-2">Full Name</label>
                <input name="fullname" class="w-full p-2 rounded-full focus:outline-none" type="text" required>
            </div>
            <div class="mb-4">
                <label class="block text-white mb-2">Address</label>
                <input name="address" class="w-full p-2 rounded-full focus:outline-none" type="text" required>
            </div>
            <div class="mb-4">
                <label class="block text-white mb-2">Phone</label>
                <input name="phone" class="w-full p-2 rounded-full focus:outline-none" type="text" required>
            </div>
            <div class="mb-4">
                <label class="block text-white mb-2">Birthday date</label>
                <div class="flex justify-center">
                    <input name="birthday" class="w-full p-2 rounded-full focus:outline-none" type="date" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-white mb-2">Profile Picture</label>
                <input name="profile_picture" type="file" accept="image/*"
                    class="bg-white text-teal-700 py-2 px-4 rounded-full w-full" onchange="previewImage(event)">
                <div class="relative mt-4">
                    <img id="preview" class="w-32 h-32 object-cover rounded-full cursor-pointer" src="#" alt="Preview"
                        style="display: none;" onmouseover="showTrashIcon()" onmouseout="hideTrashIcon()"
                        onclick="deleteProfilePicture()">
                    <i id="trashIcon"
                        class="fas fa-trash-alt absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-red-600 text-3xl"
                        style="display: none;"></i>
                </div>
            </div>

            <button type="submit" class="bg-gray-600 text-white py-2 px-4 rounded-full w-full">
                Save
            </button>
        </form>
    </div>

    <!-- Main content -->
    <main class="container mx-auto mt-8 px-6">
        <p class="text-gray-500 text-sm">
            Last Updated on 2 December 2024 12:50 (UTC +7)
        </p>
        <h1 class="text-2xl font-semibold mt-2">
            Book and get the best AirAsia flight deals
        </h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold">
                    Kota Kinabalu (BKI) → Kuching (KCH)
                </h2>
                <p class="text-gray-600">
                    Thu, 5 Dec · Direct
                </p>
                <div class="flex items-center mt-4">
                    <img alt="AirAsia Logo" class="h-10" height="40"
                        src="https://storage.googleapis.com/a1aa/image/De1KuMZSVyU6SqasEHHebBCxPxWpTogpfCYNGiy6D3UmCmtnA.jpg"
                        width="40" />
                    <span class="ml-2 text-gray-600">
                        AirAsia
                    </span>
                </div>
                <div class="flex justify-between items-center mt-4">
                    <div>
                        <p class="text-gray-500 text-sm">
                            Start from
                        </p>
                        <p class="text-red-500 text-xl font-semibold">
                            Rp 411.654
                        </p>
                        <p class="text-gray-500 text-sm">
                            Price/ Pax
                        </p>
                    </div>
                    <button class="bg-red-500 text-white px-4 py-2 rounded">
                        Select
                    </button>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold">
                    Sibu (SBW) → Kuala Lumpur (KUL)
                </h2>
                <p class="text-gray-600">
                    Thu, 5 Dec · Direct
                </p>
                <div class="flex items-center mt-4">
                    <img alt="AirAsia Logo" class="h-10" height="40"
                        src="https://storage.googleapis.com/a1aa/image/De1KuMZSVyU6SqasEHHebBCxPxWpTogpfCYNGiy6D3UmCmtnA.jpg"
                        width="40" />
                    <span class="ml-2 text-gray-600">
                        AirAsia
                    </span>
                </div>
                <div class="flex justify-between items-center mt-4">
                    <div>
                        <p class="text-gray-500 text-sm">
                            Start from
                        </p>
                        <p class="text-red-500 text-xl font-semibold">
                            Rp 411.654
                        </p>
                        <p class="text-gray-500 text-sm">
                            Price/ Pax
                        </p>
                    </div>
                    <button class="bg-red-500 text-white px-4 py-2 rounded">
                        Select
                    </button>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold">
                    Thiruvananthapuram (TRV) → Kuala Lumpur (KUL)
                </h2>
                <p class="text-gray-600">
                    Tue, 14 Jan · Direct
                </p>
                <div class="flex items-center mt-4">
                    <img alt="AirAsia Logo" class="h-10" height="40"
                        src="https://storage.googleapis.com/a1aa/image/De1KuMZSVyU6SqasEHHebBCxPxWpTogpfCYNGiy6D3UmCmtnA.jpg"
                        width="40" />
                    <span class="ml-2 text-gray-600">
                        AirAsia
                    </span>
                </div>
                <div class="flex justify-between items-center mt-4">
                    <div>
                        <p class="text-gray-500 text-sm">
                            Start from
                        </p>
                        <p class="text-red-500 text-xl font-semibold">
                            Rp 1.488.521
                        </p>
                        <p class="text-gray-500 text-sm">
                            Price/ Pax
                        </p>
                    </div>
                    <button class="bg-red-500 text-white px-4 py-2 rounded">
                        Select
                    </button>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold">
                    Ho Chi Minh City (SGN) → Penang George Town (PEN)
                </h2>
                <p class="text-gray-600">
                    Mon, 6 Jan · Direct
                </p>
                <div class="flex items-center mt-4">
                    <img alt="AirAsia Logo" class="h-10" height="40"
                        src="https://storage.googleapis.com/a1aa/image/De1KuMZSVyU6SqasEHHebBCxPxWpTogpfCYNGiy6D3UmCmtnA.jpg"
                        width="40" />
                    <span class="ml-2 text-gray-600">
                        AirAsia
                    </span>
                </div>
                <div class="flex justify-between items-center mt-4">
                    <div>
                        <p class="text-gray-500 text-sm">
                            Start from
                        </p>
                        <p class="text-red-500 text-xl font-semibold">
                            Rp 878.674
                        </p>
                        <p class="text-gray-500 text-sm">
                            Price/ Pax
                        </p>
                    </div>
                    <button class="bg-red-500 text-white px-4 py-2 rounded">
                        Select
                    </button>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold">
                    Kuala Lumpur (KUL) → Bali Denpasar (DPS)
                </h2>
                <p class="text-gray-600">
                    Thu, 5 Dec · Direct
                </p>
                <div class="flex items-center mt-4">
                    <img alt="AirAsia Logo" class="h-10" height="40"
                        src="https://storage.googleapis.com/a1aa/image/De1KuMZSVyU6SqasEHHebBCxPxWpTogpfCYNGiy6D3UmCmtnA.jpg"
                        width="40" />
                    <span class="ml-2 text-gray-600">
                        AirAsia
                    </span>
                </div>
                <div class="flex justify-between items-center mt-4">
                    <div>
                        <p class="text-gray-500 text-sm">
                            Start from
                        </p>
                        <p class="text-red-500 text-xl font-semibold">
                            Rp 706.847
                        </p>
                        <p class="text-gray-500 text-sm">
                            Price/ Pax
                        </p>
                    </div>
                    <button class="bg-red-500 text-white px-4 py-2 rounded">
                        Select
                    </button>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold">
                    Phuket (HKT) → Kuala Lumpur (KUL)
                </h2>
                <p class="text-gray-600">
                    Thu, 5 Dec · Direct
                </p>
                <div class="flex items-center mt-4">
                    <img alt="AirAsia Logo" class="h-10" height="40"
                        src="https://storage.googleapis.com/a1aa/image/De1KuMZSVyU6SqasEHHebBCxPxWpTogpfCYNGiy6D3UmCmtnA.jpg"
                        width="40" />
                    <span class="ml-2 text-gray-600">
                        AirAsia
                    </span>
                </div>
                <div class="flex justify-between items-center mt-4">
                    <div>
                        <p class="text-gray-500 text-sm">
                            Start from
                        </p>
                        <p class="text-red-500 text-xl font-semibold">
                            Rp 623.151
                        </p>
                        <p class="text-gray-500 text-sm">
                            Price/ Pax
                        </p>
                    </div>
                    <button class="bg-red-500 text-white px-4 py-2 rounded">
                        Select
                    </button>
                </div>
            </div>
        </div>
    </main>
    <script>
    // JavaScript untuk menangani klik pada ikon profil
    const profileIcon = document.getElementById('profileIcon');
    const sidebar = document.getElementById('sidebar');
    const body = document.body; // Menangani klik di luar sidebar

    // Fungsi untuk men-toggle tampilan sidebar
    function toggleSidebar() {
        sidebar.classList.toggle('translate-x-full');
    }

    // Event listener untuk ikon profil
    profileIcon.addEventListener('click', (e) => {
        toggleSidebar();
        e.stopPropagation(); // Menghindari klik pada ikon profil menutup sidebar
    });

    // Menutup sidebar ketika klik di luar sidebar
    body.addEventListener('click', (e) => {
        if (!sidebar.contains(e.target) && !profileIcon.contains(e.target)) {
            sidebar.classList.add('translate-x-full');
        }
    });

    // Mencegah klik di dalam sidebar menutup sidebar
    sidebar.addEventListener('click', (e) => {
        e.stopPropagation();
    });

    // Fitur preview gambar
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('preview');
            preview.src = reader.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Show trash icon on hover
    function showTrashIcon() {
        document.getElementById('trashIcon').style.display = 'block';
    }

    // Hide trash icon when not hovering
    function hideTrashIcon() {
        document.getElementById('trashIcon').style.display = 'none';
    }

    // Delete profile picture with AJAX
    function deleteProfilePicture() {
        if (confirm('Are you sure you want to delete your profile picture?')) {
            fetch("{{ route('profile.deletePicture') }}", {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                })
                .then(response => {
                    if (response.ok) {
                        document.getElementById('preview').style.display = 'none';
                        alert('Profile picture deleted successfully!');
                    } else {
                        alert('Failed to delete profile picture.');
                    }
                });
        }
    }
    </script>
</body>

</html>