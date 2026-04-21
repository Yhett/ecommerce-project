@extends('layout')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-3xl font-bold mb-8">Welcome Back, {{ Auth::user()->name }}!</h1>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Quick Stats -->
                        <div class="stat-card bg-gradient-to-r from-purple-500 to-pink-500 text-white p-8 rounded-2xl shadow-2xl hover:scale-105 transition-all duration-300">
                            <div class="text-4xl mb-2">🛒</div>
                            <h3 class="text-2xl font-bold mb-1">{{ \App\Models\Cart::where('user_id', auth()->id())->sum('quantity') }}</h3>
                            <p class="opacity-90">Items in Cart</p>
                        </div>

                        <div class="stat-card bg-gradient-to-r from-blue-500 to-indigo-500 text-white p-8 rounded-2xl shadow-2xl hover:scale-105 transition-all duration-300">
                            <div class="text-4xl mb-2">📦</div>
                            <h3 class="text-2xl font-bold mb-1">{{ \App\Models\Order::where('user_id', auth()->id())->count() }}</h3>
                            <p class="opacity-90">Total Orders</p>
                        </div>

                        <div class="stat-card bg-gradient-to-r from-emerald-500 to-teal-500 text-white p-8 rounded-2xl shadow-2xl hover:scale-105 transition-all duration-300">
                            <div class="text-4xl mb-2">⭐</div>
                            <h3 class="text-2xl font-bold mb-1">4.8</h3>
                            <p class="opacity-90">Average Rating</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-12">
                        <!-- Quick Actions -->
                        <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700">
                            <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">Quick Actions</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <a href="/products" class="group flex items-center p-4 rounded-xl bg-gradient-to-r from-purple-50 to-pink-50 hover:from-purple-100 hover:to-pink-100 transition-all border border-purple-100 group-hover:shadow-lg">
                                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                                        <i class="fas fa-shopping-bag text-white"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg text-gray-800 group-hover:text-purple-700">Shop Products</h3>
                                        <p class="text-gray-600 text-sm">Browse our collection</p>
                                    </div>
                                </a>



                                <a href="/cart" class="group flex items-center p-4 rounded-xl bg-gradient-to-r from-emerald-50 to-teal-50 hover:from-emerald-100 hover:to-teal-100 transition-all border border-emerald-100 group-hover:shadow-lg">
                                    <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                                        <i class="fas fa-shopping-cart text-white"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg text-gray-800 group-hover:text-emerald-700">View Cart</h3>
                                        <p class="text-gray-600 text-sm">Review cart items</p>
                                    </div>
                                </a>

                                <a href="{{ route('profile.edit') }}" class="group flex items-center p-4 rounded-xl bg-gradient-to-r from-orange-50 to-yellow-50 hover:from-orange-100 hover:to-yellow-100 transition-all border border-orange-100 group-hover:shadow-lg">
                                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-yellow-500 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg text-gray-800 group-hover:text-orange-700">Edit Profile</h3>
                                        <p class="text-gray-600 text-sm">Update your info</p>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Recent Activity -->
                        <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700">
                            <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">Recent Activity</h2>
                            <div class="space-y-4">
                                <div class="flex items-center p-4 bg-gray-50 dark:bg-gray-900 rounded-xl">
                                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-xl flex items-center justify-center mr-4">
                                        <i class="fas fa-bell text-blue-600 dark:text-blue-400 text-xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900 dark:text-gray-100">New notification</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">2 minutes ago</p>
                                    </div>
                                </div>

                                <div class="flex items-center p-4 bg-gray-50 dark:bg-gray-900 rounded-xl">
                                    <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900 rounded-xl flex items-center justify-center mr-4">
                                        <i class="fas fa-check-circle text-emerald-600 dark:text-emerald-400 text-xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900 dark:text-gray-100">Profile updated</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">1 hour ago</p>
                                    </div>
                                </div>

                                <div class="flex items-center p-4 bg-gray-50 dark:bg-gray-900 rounded-xl">
                                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-xl flex items-center justify-center mr-4">
                                        <i class="fas fa-shopping-cart text-purple-600 dark:text-purple-400 text-xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-900 dark:text-gray-100">Item added to cart</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Yesterday</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
