@extends('layouts.app')

@section('content')
<div x-data="{ 
    showAddModal: false, 
    showEditModal: false, 
    editingProject: null,
    setEditProject(project) {
        this.editingProject = project;
        this.showEditModal = true;
    }
}" class="max-w-7xl mx-auto px-6 py-24 min-h-screen">
    <div class="flex flex-col md:flex-row justify-between items-end mb-20 reveal">
        <div class="max-w-2xl">
            <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-6">My Gallery <i class="fas fa-camera-retro text-soft-purple ml-2"></i></h1>
            <p class="text-gray-500 text-xl font-medium leading-relaxed">A collection of my creative works and beautiful memories, captured with <i class="fas fa-heart text-soft-pink"></i>.</p>
        </div>
        <button @click="showAddModal = true" class="mt-10 md:mt-0 btn-pastel btn-purple flex items-center shadow-xl hover:shadow-2xl px-10 py-5 text-lg">
            <i class="fas fa-plus-circle mr-3 text-2xl"></i> Add New Memory
        </button>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
        @forelse($projects as $project)
        <div class="glass-card overflow-hidden group card-hover reveal bg-white/40 border-2 border-white/60">
            <div class="relative h-72 overflow-hidden">
                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                <div class="absolute top-6 right-6 bg-white/90 backdrop-blur-md px-5 py-2 rounded-2xl text-sm font-bold text-soft-purple shadow-sm border border-white">
                    {{ $project->type }}
                </div>
                
                <!-- Quick Actions Overlay -->
                <div class="absolute inset-0 bg-soft-pink/20 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center space-x-6">
                    <button @click="setEditProject({{ json_encode($project) }})" class="w-14 h-14 rounded-2xl bg-white text-soft-purple flex items-center justify-center shadow-xl hover:scale-110 transition-transform border-2 border-white/50">
                        <i class="fas fa-edit text-xl"></i>
                    </button>
                    <form action="{{ route('projects.delete', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this memory?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-14 h-14 rounded-2xl bg-white text-soft-pink flex items-center justify-center shadow-xl hover:scale-110 transition-transform border-2 border-white/50">
                            <i class="fas fa-trash-alt text-xl"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="p-10">
                <div class="flex justify-between items-start mb-6">
                    <h3 class="text-2xl font-bold text-gray-800 group-hover:text-soft-pink transition-colors">{{ $project->title }}</h3>
                    <span class="bg-pastel-peach/50 px-3 py-1 rounded-xl text-gray-500 text-xs font-bold border border-white/40">
                        <i class="far fa-calendar-alt mr-1"></i>{{ \Carbon\Carbon::parse($project->date)->format('M d, Y') }}
                    </span>
                </div>
                <p class="text-gray-600 leading-relaxed line-clamp-3 mb-8 font-medium">
                    {{ $project->description }}
                </p>
                <div class="flex justify-end pt-6 border-t border-white/40">
                    <button @click="setEditProject({{ json_encode($project) }})" class="text-soft-purple hover:text-soft-pink font-bold text-sm transition-all flex items-center group/btn">
                        View & Edit Details <i class="fas fa-arrow-right ml-2 transform group-hover/btn:translate-x-1 transition-transform"></i>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-32 text-center reveal">
            <div class="w-40 h-40 mx-auto mb-10 bg-white/40 rounded-[2.5rem] flex items-center justify-center text-soft-pink/30 text-6xl shadow-inner border-2 border-white/60">
                <i class="fas fa-images"></i>
            </div>
            <h3 class="text-3xl font-bold text-gray-500">Your gallery is currently empty.</h3>
            <p class="text-gray-400 mt-4 text-xl font-medium">Start adding some beautiful creative memories!</p>
            <button @click="showAddModal = true" class="mt-10 btn-pastel btn-pink px-10 py-4">Add Your First Item</button>
        </div>
        @endforelse
    </div>

    <!-- Add Item Modal -->
    <div x-show="showAddModal" 
         x-cloak
         class="fixed inset-0 z-[200] overflow-y-auto flex items-center justify-center p-4"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div class="fixed inset-0 bg-black/30 backdrop-blur-md" @click="showAddModal = false"></div>
        
        <div class="glass-card w-full max-w-2xl p-10 relative z-10 border-2 border-white/80 shadow-2xl"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90 translate-y-8"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            
            <div class="flex justify-between items-center mb-10">
                <h3 class="text-3xl font-bold text-gray-800">Add New Memory <i class="fas fa-sparkles text-soft-pink ml-2"></i></h3>
                <button @click="showAddModal = false" class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:text-soft-pink transition-colors"><i class="fas fa-times text-xl"></i></button>
            </div>

            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="block text-gray-700 font-bold ml-2">Title</label>
                        <input type="text" name="title" required class="w-full px-6 py-4 rounded-2xl border-2 border-white bg-white/50 focus:border-soft-purple focus:ring-0 transition-all outline-none font-medium" placeholder="Give it a name...">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-gray-700 font-bold ml-2">Type</label>
                        <select name="type" required class="w-full px-6 py-4 rounded-2xl border-2 border-white bg-white/50 focus:border-soft-purple focus:ring-0 transition-all outline-none appearance-none font-medium">
                            <option value="Art">Art</option>
                            <option value="Photography">Photography</option>
                            <option value="Design">Design</option>
                            <option value="School Project">School Project</option>
                            <option value="Hobby">Hobby</option>
                        </select>
                    </div>
                </div>
                
                <div class="space-y-2">
                    <label class="block text-gray-700 font-bold ml-2">Description</label>
                    <textarea name="description" required rows="4" class="w-full px-6 py-4 rounded-2xl border-2 border-white bg-white/50 focus:border-soft-purple focus:ring-0 transition-all outline-none font-medium" placeholder="Tell the story behind this work..."></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="block text-gray-700 font-bold ml-2">Date</label>
                        <input type="date" name="date" required class="w-full px-6 py-4 rounded-2xl border-2 border-white bg-white/50 focus:border-soft-purple focus:ring-0 transition-all outline-none font-medium">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-gray-700 font-bold ml-2">Image</label>
                        <div class="relative w-full px-6 py-4 rounded-2xl border-2 border-dashed border-pastel-pink bg-pastel-pink/10 flex items-center justify-center transition-all hover:bg-pastel-pink/20 cursor-pointer">
                            <input type="file" name="image" required class="absolute inset-0 opacity-0 cursor-pointer">
                            <i class="fas fa-image text-soft-pink mr-3"></i>
                            <span class="text-soft-pink font-bold">Choose Image</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full btn-pastel btn-purple py-5 text-xl shadow-lg mt-4">Save to Gallery</button>
            </form>
        </div>
    </div>

    <!-- Edit Item Modal -->
    <div x-show="showEditModal" 
         x-cloak
         class="fixed inset-0 z-[200] overflow-y-auto flex items-center justify-center p-4"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div class="fixed inset-0 bg-black/30 backdrop-blur-md" @click="showEditModal = false"></div>
        
        <div class="glass-card w-full max-w-2xl p-10 relative z-10 border-2 border-white/80 shadow-2xl"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90 translate-y-8"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            
            <div class="flex justify-between items-center mb-10">
                <h3 class="text-3xl font-bold text-gray-800">Edit Memory <i class="fas fa-edit text-soft-purple ml-2"></i></h3>
                <button @click="showEditModal = false" class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:text-soft-pink transition-colors"><i class="fas fa-times text-xl"></i></button>
            </div>

            <form :action="editingProject ? `/projects/update/${editingProject.id}` : ''" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="block text-gray-700 font-bold ml-2">Title</label>
                        <input type="text" name="title" :value="editingProject?.title" required class="w-full px-6 py-4 rounded-2xl border-2 border-white bg-white/50 focus:border-soft-purple focus:ring-0 transition-all outline-none font-medium">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-gray-700 font-bold ml-2">Type</label>
                        <select name="type" :value="editingProject?.type" required class="w-full px-6 py-4 rounded-2xl border-2 border-white bg-white/50 focus:border-soft-purple focus:ring-0 transition-all outline-none appearance-none font-medium">
                            <option value="Art">Art</option>
                            <option value="Photography">Photography</option>
                            <option value="Design">Design</option>
                            <option value="School Project">School Project</option>
                            <option value="Hobby">Hobby</option>
                        </select>
                    </div>
                </div>
                
                <div class="space-y-2">
                    <label class="block text-gray-700 font-bold ml-2">Description</label>
                    <textarea name="description" required rows="4" class="w-full px-6 py-4 rounded-2xl border-2 border-white bg-white/50 focus:border-soft-purple focus:ring-0 transition-all outline-none font-medium" x-text="editingProject?.description"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="block text-gray-700 font-bold ml-2">Date</label>
                        <input type="date" name="date" :value="editingProject?.date" required class="w-full px-6 py-4 rounded-2xl border-2 border-white bg-white/50 focus:border-soft-purple focus:ring-0 transition-all outline-none font-medium">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-gray-700 font-bold ml-2">New Image (Optional)</label>
                        <div class="relative w-full px-6 py-4 rounded-2xl border-2 border-dashed border-pastel-pink bg-pastel-pink/10 flex items-center justify-center transition-all hover:bg-pastel-pink/20 cursor-pointer">
                            <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-soft-pink mr-3"></i>
                            <span class="text-soft-pink font-bold">Update Image</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full btn-pastel btn-purple py-5 text-xl shadow-lg mt-4">Update Memory</button>
            </form>
        </div>
    </div>
</div>
@endsection
