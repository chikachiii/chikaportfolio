@extends('layouts.app')

@section('content')
<div x-data="{ showUploadModal: false }">
    <!-- Hero Section -->
    <section class="min-h-[90vh] flex flex-col items-center justify-center text-center px-6 relative overflow-hidden">
        <!-- Decorative Icons (Floating) -->
        <div class="absolute top-1/4 left-1/4 text-soft-pink animate-float text-4xl opacity-50"><i class="fas fa-heart"></i></div>
        <div class="absolute bottom-1/4 right-1/4 text-soft-purple animate-float text-5xl opacity-50" style="animation-delay: 1s;"><i class="fas fa-star"></i></div>
        <div class="absolute top-1/3 right-1/5 text-soft-peach animate-float text-3xl opacity-50" style="animation-delay: 0.5s;"><i class="fas fa-sparkles"></i></div>
        <div class="absolute bottom-1/3 left-1/5 text-soft-lilac animate-float text-4xl opacity-50" style="animation-delay: 1.5s;"><i class="fas fa-flower"></i></div>

        <div class="reveal max-w-5xl">
            <h1 class="text-6xl md:text-8xl font-bold mb-8 drop-shadow-sm leading-tight">
                <span class="text-gradient">Portfolio Jessica Frederine Setiawan</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-500 max-w-3xl mx-auto leading-relaxed font-medium">
                Exploring the world through <span class="text-soft-pink">Art</span>, <span class="text-soft-purple">Design</span>, and <span class="text-soft-peach">Creativity</span>. 🎨✨
            </p>
            <div class="mt-12 flex justify-center space-x-6">
                <a href="{{ route('projects.index') }}" class="btn-pastel btn-pink text-lg px-10 py-4 shadow-xl">Explore My Work</a>
                <a href="#profile" class="btn-pastel bg-white/60 text-soft-purple hover:bg-white text-lg px-10 py-4 shadow-xl">About Me</a>
            </div>
        </div>
    </section>

    <!-- Profile Section -->
    <section id="profile" class="py-32 px-6 relative z-10">
        <div class="max-w-5xl mx-auto">
            <div class="glass-card-purple p-10 md:p-16 text-center reveal border-2 border-white/50 relative overflow-hidden">
                @if($profile)
                <!-- Background decorative element -->
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-soft-pink/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-soft-peach/10 rounded-full blur-3xl"></div>

                <div class="relative w-56 h-56 mx-auto mb-10 group">
                    <div class="w-full h-full rounded-full overflow-hidden border-8 border-white shadow-2xl bg-pastel-pink flex items-center justify-center transition-transform duration-500 group-hover:scale-105">
                        @if($profile->profile_image)
                            <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="Profile" class="w-full h-full object-cover">
                        @else
                            <i class="fas fa-user text-7xl text-white"></i>
                        @endif
                    </div>
                    <div class="absolute -bottom-2 -right-2 flex space-x-2">
                        <button @click="showUploadModal = true" class="w-12 h-12 rounded-2xl bg-white text-soft-pink flex items-center justify-center shadow-lg hover:scale-110 transition-all border-2 border-pastel-pink">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>
                </div>

                <div class="space-y-6 relative z-10">
                    <h2 class="text-5xl font-bold text-gray-800">{{ $profile->name }}</h2>
                    <div class="flex flex-wrap justify-center gap-4 text-gray-700 font-bold">
                        <span class="bg-white/60 px-6 py-2 rounded-2xl shadow-sm border border-white/40"><i class="fas fa-birthday-cake mr-2 text-soft-pink"></i>{{ $profile->age }} Years Old</span>
                        <span class="bg-white/60 px-6 py-2 rounded-2xl shadow-sm border border-white/40"><i class="fas fa-calendar-alt mr-2 text-soft-purple"></i>{{ \Carbon\Carbon::parse($profile->birth_date)->format('d F Y') }}</span>
                        <span class="bg-white/60 px-6 py-2 rounded-2xl shadow-sm border border-white/40"><i class="fas fa-school mr-2 text-soft-peach"></i>{{ $profile->school }}</span>
                        <span class="bg-white/60 px-6 py-2 rounded-2xl shadow-sm border border-white/40"><i class="fas fa-graduation-cap mr-2 text-soft-pink"></i>Class {{ $profile->class }}</span>
                    </div>
                    <div class="max-w-3xl mx-auto mt-10 p-8 rounded-[2rem] bg-white/40 border border-white/60">
                        <p class="text-xl text-gray-600 leading-relaxed italic font-medium">
                            "{{ $profile->description }}"
                        </p>
                    </div>
                    
                    <div class="pt-8 flex justify-center space-x-4">
                        <button @click="showUploadModal = true" class="btn-pastel btn-pink">
                            <i class="fas fa-upload mr-2"></i> Update Photo
                        </button>
                        @if($profile->profile_image)
                        <form action="{{ route('profile.delete-photo') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-pastel btn-outline">
                                <i class="fas fa-trash-alt mr-2"></i> Remove Photo
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                @else
                <div class="py-20">
                    <i class="fas fa-user-circle text-8xl text-soft-pink/30 mb-6"></i>
                    <h2 class="text-3xl font-bold text-gray-500">Profile data not found.</h2>
                    <p class="text-gray-400 mt-2">Please run the seeder to initialize your profile.</p>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Upload Modal -->
    <div x-show="showUploadModal" 
         x-cloak
         class="fixed inset-0 z-[200] overflow-y-auto flex items-center justify-center p-4"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div class="fixed inset-0 bg-black/30 backdrop-blur-md" @click="showUploadModal = false"></div>
        
        <div class="glass-card w-full max-w-md p-10 relative z-10 border-2 border-white/80 shadow-2xl"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90 translate-y-8"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            
            <button @click="showUploadModal = false" class="absolute top-6 right-6 text-gray-400 hover:text-soft-pink transition-colors">
                <i class="fas fa-times text-2xl"></i>
            </button>

            <h3 class="text-3xl font-bold text-gray-800 mb-8 text-center">Upload Photo</h3>
            
            <form action="{{ route('profile.upload-photo') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <div class="group relative">
                    <div class="w-full h-48 border-4 border-dashed border-pastel-pink rounded-3xl bg-pastel-pink/20 flex flex-col items-center justify-center transition-all group-hover:bg-pastel-pink/30 cursor-pointer">
                        <input type="file" name="profile_image" required class="absolute inset-0 opacity-0 cursor-pointer" onchange="this.form.submit()">
                        <i class="fas fa-cloud-upload-alt text-5xl text-soft-pink mb-4"></i>
                        <p class="text-gray-500 font-bold">Click or drag photo here</p>
                        <p class="text-gray-400 text-sm mt-2">Max size: 2MB (JPG, PNG)</p>
                    </div>
                </div>
                
                <div class="flex flex-col space-y-3">
                    <p class="text-center text-gray-400 text-sm italic">Uploading will automatically update your profile.</p>
                </div>
            </form>
        </div>
    </div>

    <!-- Skills Section -->
    <section class="py-32 px-6 bg-soft-lilac/20">
        <div class="max-w-6xl mx-auto">
            <h2 class="section-title reveal">Soft Skills <i class="fas fa-magic text-soft-pink ml-2"></i></h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @php
                    $skills = [
                        ['name' => 'Drawing & Painting', 'icon' => 'fa-palette', 'color' => 'bg-pastel-pink', 'quote' => 'Art adalah cara mengekspresikan perasaan tanpa kata-kata.', 'decoration' => 'fa-star'],
                        ['name' => 'Creativity', 'icon' => 'fa-lightbulb', 'color' => 'bg-pastel-purple', 'quote' => 'Kreativitas adalah kecerdasan yang sedang bersenang-senang.', 'decoration' => 'fa-wand-magic-sparkles'],
                        ['name' => 'Fashion', 'icon' => 'fa-shirt', 'color' => 'bg-pastel-peach', 'quote' => 'Fashion adalah bentuk ekspresi diri.', 'decoration' => 'fa-heart'],
                        ['name' => 'Leadership', 'icon' => 'fa-users', 'color' => 'bg-pastel-blue', 'quote' => 'Pemimpin yang baik membantu orang lain berkembang.', 'decoration' => 'fa-crown'],
                        ['name' => 'Inspiring', 'icon' => 'fa-magic', 'color' => 'bg-soft-lilac', 'quote' => 'Hal kecil bisa memberi inspirasi besar.', 'decoration' => 'fa-sparkles'],
                        ['name' => 'Photography', 'icon' => 'fa-camera', 'color' => 'bg-pastel-pink', 'quote' => 'Mengabadikan momen yang bercerita.', 'decoration' => 'fa-camera-retro'],
                    ];
                @endphp

                @foreach($skills as $skill)
                <div class="glass-card p-10 card-hover reveal bg-white/50 border-2 border-white/80 relative overflow-hidden group">
                    <!-- Floating Decoration Background -->
                    <div class="absolute -top-6 -right-6 text-soft-pink/10 text-8xl transform rotate-12 transition-all duration-700 group-hover:scale-125 group-hover:rotate-45 group-hover:text-soft-pink/20">
                        <i class="fas {{ $skill['decoration'] }}"></i>
                    </div>

                    <div class="flex items-center mb-8 relative z-10">
                        <div class="w-16 h-16 rounded-[1.5rem] {{ $skill['color'] }} flex items-center justify-center text-soft-pink text-3xl mr-6 shadow-sm border-2 border-white">
                            <i class="fas {{ $skill['icon'] }}"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 text-2xl tracking-tight">{{ $skill['name'] }}</h3>
                        </div>
                    </div>
                    
                    <div class="relative z-10">
                        <p class="text-gray-600 text-lg font-medium italic leading-relaxed">
                            "{{ $skill['quote'] }}"
                        </p>
                    </div>
                    
                    <!-- Bottom Cute Decorations -->
                    <div class="mt-8 flex items-center space-x-3 relative z-10">
                        <div class="flex -space-x-1">
                            <i class="fas fa-circle text-[6px] text-soft-pink animate-pulse"></i>
                            <i class="fas fa-circle text-[6px] text-soft-purple animate-pulse" style="animation-delay: 0.3s"></i>
                            <i class="fas fa-circle text-[6px] text-soft-peach animate-pulse" style="animation-delay: 0.6s"></i>
                        </div>
                        <div class="h-[1px] flex-grow bg-gradient-to-r from-soft-pink/30 to-transparent"></div>
                        <i class="fas {{ $skill['decoration'] }} text-soft-pink/40 text-sm"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Fields / Interests Section -->
    <section class="py-32 px-6">
        <div class="max-w-7xl mx-auto">
            <h2 class="section-title reveal">Fields & Interests <i class="fas fa-sparkles text-soft-purple ml-2"></i></h2>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @php
                    $interests = [
                        ['name' => 'Art & Illustration', 'icon' => 'fa-brush', 'color' => 'bg-pastel-pink'],
                        ['name' => 'Fashion Design', 'icon' => 'fa-shirt', 'color' => 'bg-pastel-purple'],
                        ['name' => 'Creative Content', 'icon' => 'fa-video', 'color' => 'bg-pastel-peach'],
                        ['name' => 'Photography', 'icon' => 'fa-camera-retro', 'color' => 'bg-pastel-blue'],
                        ['name' => 'School Projects', 'icon' => 'fa-project-diagram', 'color' => 'bg-soft-lilac'],
                    ];
                @endphp

                @foreach($interests as $interest)
                <div class="glass-card p-10 text-center card-hover bg-white/40 border-2 border-white/60 reveal">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-3xl {{ $interest['color'] }} flex items-center justify-center text-soft-pink text-3xl border-2 border-white shadow-inner">
                        <i class="fas {{ $interest['icon'] }}"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg leading-tight">{{ $interest['name'] }}</h3>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
