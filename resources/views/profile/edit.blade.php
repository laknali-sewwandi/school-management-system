<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings | School MS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">

    <div class="min-h-screen flex">
        
        @include('layouts.sidebar')

        <div class="flex-1 p-8">
            <header class="mb-10">
                <h1 class="text-2xl font-bold text-gray-800">Profile Settings</h1>
            </header>
            
            <div class="max-w-4xl space-y-6">
                <div class="p-8 bg-white shadow-sm rounded-3xl border border-gray-100">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <hr>
                <div class="p-8 bg-white shadow-sm rounded-3xl border border-gray-100">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <hr>
                <div class="p-8 bg-white shadow-sm rounded-3xl border border-gray-100">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>