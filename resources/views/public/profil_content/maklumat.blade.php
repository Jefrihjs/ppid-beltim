<h1 class="text-4xl md:text-5xl font-extrabold mb-16 text-slate-900 text-center tracking-tight">
    Maklumat Pelayanan <br class="hidden md:block"> Informasi Publik
</h1>

@php
$items = [
    "Menyediakan, memberikan dan/atau menerbitkan Informasi Publik yang bersifat terbuka, selain informasi yang dikecualikan sesuai dengan ketentuan perundang-undangan;",
    "Menyediakan Informasi Publik yang akurat, benar dan tidak menyesatkan;",
    "Memberikan kemudahan dalam mendapatkan dan mengakses Informasi Publik;",
    "Memberikan pelayanan informasi dengan cepat dan tepat;",
    "Menyebarluaskan Informasi Publik dengan cara yang mudah dijangkau dan dimengerti masyarakat;",
    "Meningkatkan kualitas dalam memberikan layanan Informasi Publik;"
];
@endphp

<div class="grid md:grid-cols-2 gap-8">
    @foreach($items as $i => $text)
    <div class="group bg-white p-8 rounded-3xl shadow-sm border border-slate-100 
                hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500 hover:-translate-y-1">
        
        <div class="flex items-start gap-8">
            <div class="flex-shrink-0 w-14 h-14 flex items-center justify-center 
                        rounded-2xl bg-slate-900 text-amber-400 
                        text-2xl font-black shadow-lg group-hover:bg-amber-500 group-hover:text-white transition-colors duration-300">
                {{ sprintf('%02d', $i+1) }}
            </div>

            <div class="pt-1">
                <p class="text-slate-700 leading-relaxed text-lg font-medium group-hover:text-slate-900 transition-colors">
                    {{ $text }}
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>