<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>RIS Rental Information System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-white p-4 flex items-center justify-between shadow-md">
        <div class="relative w-1/3">
            <input class="pl-10 pr-4 py-2 w-full rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Search" type="text" />
            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
        </div>
        <h1 class="text-gray-800 text-lg font-bold">RIS RENTAL INFORMATION SYSTEM</h1>

        <!-- Profile Icon -->
        <div class="flex items-center gap-4">
            <img id="profileIcon"
                src="{{ Auth::user()->profile->profile_picture ? asset('storage/' . Auth::user()->profile->profile_picture) : asset('default-avatar.png') }}"
                alt="Profile Picture"
                class="w-10 h-10 rounded-full cursor-pointer border-2 border-gray-800 object-cover">
        </div>
    </header>

    <!-- Sidebar Profile User -->
    <div id="sidebar"
        class="fixed top-0 right-0 w-1/4 h-full bg-white p-6 rounded-lg shadow-md transform translate-x-full transition-all ease-in-out duration-300">
        <h2 class="text-gray-800 text-lg mb-4">Profile User</h2>

        <!-- Profile Form -->
        <form action="{{ route('profile.save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-800 mb-2">Full Name</label>
                <input name="fullname" class="w-full px-3 py-2 text-gray-800 rounded-lg border" type="text" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-800 mb-2">Address</label>
                <input name="address" class="w-full px-3 py-2 text-gray-800 rounded-lg border" type="text" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-800 mb-2">Phone</label>
                <input name="phone" class="w-full px-3 py-2 text-gray-800 rounded-lg border" type="text" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-800 mb-2">Birthday date</label>
                <input name="birthday" class="w-full px-3 py-2 text-gray-800 rounded-lg border" type="date" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-800 mb-2">Profile Picture</label>
                <input name="profile_picture" type="file" accept="image/*"
                    class="w-full px-3 py-2 text-gray-800 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-500 file:text-white hover:file:bg-yellow-400"
                    onchange="previewImage(event)">
                <div class="relative mt-4">
                    <img id="preview" class="w-32 h-32 object-cover rounded-full cursor-pointer" src="#" alt="Preview"
                        style="display: none;" onmouseover="showTrashIcon()" onmouseout="hideTrashIcon()"
                        onclick="deleteProfilePicture()">
                    <i id="trashIcon"
                        class="fas fa-trash-alt absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-gray-800 text-3xl"
                        style="display: none;"></i>
                </div>
            </div>

            <button type="submit" class="w-full bg-yellow-500 text-white py-2 rounded-lg hover:bg-yellow-400">
                Save
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto mt-8 px-6">
        <!-- Tempatkan notifikasi di sini agar tampil di area konten utama -->
        @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md mb-4">
            {{ session('success') }}
        </div>
        @endif

        <p id="lastUpdated" class="text-gray-500 text-sm"></p>

        <h1 class="text-2xl font-semibold mt-2">
            Book and get the best Room With RIS
        </h1>

        <button id="createButton" class="bg-red-500 text-white px-4 py-2 rounded mt-4">Create</button>

        <div id="createForm" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full sm:w-96 md:w-1/2">
                <h2 class="text-xl font-semibold mb-4">Create Room</h2>
                <form id="createRoomForm" action="{{ route('rooms.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700">Room Number</label>
                        <input type="text" name="rooms_number" class="w-full p-2 rounded-lg border" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Status</label>
                        <select name="status" class="w-full p-2 rounded-lg border" required>
                            <option value="tersedia">Tersedia</option>
                            <option value="ditempati">Ditempati</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Price</label>
                        <input type="number" step="0.01" name="price" class="w-full p-2 rounded-lg border" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Room Picture</label>
                        <input type="file" name="room_picture" class="w-full p-2 rounded-lg border" accept="image/*"
                            required>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Create</button>
                        <button type="button" id="closeButton"
                            class="bg-yellow-500 text-white px-4 py-2 rounded ml-2">Close</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach($rooms as $room)
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold">{{ $room->rooms_number }}</h2>
                <p class="text-gray-600">Status: {{ $room->status == 'tersedia' ? 'Tersedia' : 'Ditempati' }}</p>
                <div class="flex items-center mt-4">
                    <img alt="Room Picture" class="h-10" src="{{ asset('storage/' . $room->room_picture) }}" />
                </div>
                <div class="flex justify-between items-center mt-4">
                    <div>
                        <p class="text-gray-500 text-sm">Start from</p>
                        <p class="text-red-500 text-xl font-semibold">Rp {{ number_format($room->price, 2) }}</p>
                        <p class="text-gray-500 text-sm">Price/ Room</p>
                    </div>
                    <div>
                        <button class="bg-yellow-500 text-white px-4 py-2 rounded mb-2">Edit</button>
                        <button class="bg-red-500 text-white px-4 py-2 rounded mb-2">Delete</button>
                        <button class="bg-red-500 text-white px-4 py-2 rounded mb-2">Select</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>


    <script>
    //script untuk format tanggal updated
    function formatDate(date) {
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            timeZone: 'Asia/Jakarta'
        };
        const timeOptions = {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false,
            timeZone: 'Asia/Jakarta'
        };
        const formattedDate = date.toLocaleDateString('en-US', options);
        const formattedTime = date.toLocaleTimeString('en-US', timeOptions);
        return `${formattedDate} ${formattedTime} (UTC +7)`;
    }

    document.addEventListener("DOMContentLoaded", function() {
        const currentDate = new Date();
        const lastUpdatedElement = document.getElementById('lastUpdated');
        lastUpdatedElement.textContent = `Last Updated on ${formatDate(currentDate)}`;
    });

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

    //skrip jawa untuk menampilkan pop up form create kamar
    document.getElementById('createButton').addEventListener('click', function() {
        document.getElementById('createForm').classList.remove('hidden');
    });

    document.getElementById('closeButton').addEventListener('click', function() {
        document.getElementById('createForm').classList.add('hidden');
    });
    </script>
</body>

</html>