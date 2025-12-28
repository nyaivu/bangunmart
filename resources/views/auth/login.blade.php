<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {{-- Panggil Vite di sini --}}
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
  
  <div class="bg-white p-8 rounded-lg shadow-md w-96">
    <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">BangunMart Login</h2>
    
    <form action="/login" method="POST">
      @csrf
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Pegawai</label>
        <input type="text" name="nama_pegawai" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
        <input type="password" name="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
        Login
      </button>
    </form>
  </div>

</body>
</html>