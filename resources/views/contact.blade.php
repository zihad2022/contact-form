<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>টাইপোগ্রাফিক লোগো ডিজাইন</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        span {
            color: red;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <div class="max-w-3xl mx-auto bg-white p-8 shadow-md mt-10 rounded">

        <div class="mb-6 text-center">
            <h1 class="text-xl font-bold mt-4">টাইপোগ্রাফিক লোগো ডিজাইন</h1>
            <p class="text-sm mt-2">নিচের ফর্মটি পূরণ করুন যাতে আপনার টাইপোগ্রাফিক লোগো ডিজাইন আমরা সঠিকভাবে মূল্যায়ন
                করতে পারি।</p>
        </div>

        <form method="POST" action="{{ route('contact.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block font-medium mb-1">আপনার নাম <span>*</span></label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium mb-1">মোবাইল নাম্বার/ হোয়াটসএ্যাপ <span>*</span></label>
                <input type="text" name="mobile_number" value="{{ old('mobile_number') }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('mobile_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium mb-1">ইমেইল এড্রেস</label>
                <input type="text" name="email" value="{{ old('email') }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium mb-1">
                    যে নামে ডিজাইন হবে (বাংলায় হলে বাংলায় লিখুন) <span>*</span><br>
                    <span class="text-sm text-gray-500">
                        সংক্ষিপ্ত নাম শ্রুতিমধুর হয়ে থাকে যার ফলে আপনার প্রতিষ্ঠানের প্রচার আরও সহজ হতে পারে।
                    </span>
                </label>
                <input type="text" name="design_name" value="{{ old('design_name') }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('design_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium mb-1">
                    প্রতিষ্ঠানের ধরণ <span>*</span><br>
                    <span class="text-sm text-gray-500">
                        আপনার প্রতিষ্ঠানের কার্যক্রম সংক্রান্ত তথ্যের উপর নির্ভর করে ডিজাইন করা হবে।
                    </span>
                </label>
                <select name="organization_type" class="w-full border border-gray-300 rounded p-2">
                    <option value="">-- বাছাই করুন --</option>
                    <option value="অনলাইন নিউজ পোর্টাল"
                        {{ old('organization_type') == 'অনলাইন নিউজ পোর্টাল' ? 'selected' : '' }}>অনলাইন নিউজ পোর্টাল
                    </option>
                    <option value="দৈনিক পত্রিকা (প্রিন্ট)"
                        {{ old('organization_type') == 'দৈনিক পত্রিকা (প্রিন্ট)' ? 'selected' : '' }}>দৈনিক পত্রিকা
                        (প্রিন্ট)</option>
                    <option value="অনলাইন শপ / ই-কমার্স"
                        {{ old('organization_type') == 'অনলাইন শপ / ই-কমার্স' ? 'selected' : '' }}>অনলাইন শপ / ই-কমার্স
                    </option>
                    <option value="নিউজ চ্যানেল" {{ old('organization_type') == 'নিউজ চ্যানেল' ? 'selected' : '' }}>
                        নিউজ চ্যানেল</option>
                    <option value="অনলাইন ম্যাগাজিন / প্রিন্ট ম্যাগাজিন"
                        {{ old('organization_type') == 'অনলাইন ম্যাগাজিন / প্রিন্ট ম্যাগাজিন' ? 'selected' : '' }}>
                        অনলাইন ম্যাগাজিন / প্রিন্ট ম্যাগাজিন</option>
                    <option value="ফ্যাশন হাউজ" {{ old('organization_type') == 'ফ্যাশন হাউজ' ? 'selected' : '' }}>
                        ফ্যাশন হাউজ</option>
                    <option value="ব্যক্তিগত / ব্লগ"
                        {{ old('organization_type') == 'ব্যক্তিগত / ব্লগ' ? 'selected' : '' }}>ব্যক্তিগত / ব্লগ
                    </option>
                    <option value="ফুড এন্ড বেভারেজ"
                        {{ old('organization_type') == 'ফুড এন্ড বেভারেজ' ? 'selected' : '' }}>ফুড এন্ড বেভারেজ
                    </option>
                    <option value="সামাজিক সংগঠন" {{ old('organization_type') == 'সামাজিক সংগঠন' ? 'selected' : '' }}>
                        সামাজিক সংগঠন</option>
                    <option value="ফেইসবুক কমিউনিটি"
                        {{ old('organization_type') == 'ফেইসবুক কমিউনিটি' ? 'selected' : '' }}>ফেইসবুক কমিউনিটি
                    </option>
                    <option value="ক্রাফট / বুটিক্স / হস্তশিল্প প্রতিষ্ঠান"
                        {{ old('organization_type') == 'ক্রাফট / বুটিক্স / হস্তশিল্প প্রতিষ্ঠান' ? 'selected' : '' }}>
                        ক্রাফট / বুটিক্স / হস্তশিল্প প্রতিষ্ঠান</option>
                    <option value="হসপিটাল / স্বাস্থ্য"
                        {{ old('organization_type') == 'হসপিটাল / স্বাস্থ্য' ? 'selected' : '' }}>হসপিটাল / স্বাস্থ্য
                    </option>
                    <option value="আর্টিস্ট" {{ old('organization_type') == 'আর্টিস্ট' ? 'selected' : '' }}>আর্টিস্ট
                    </option>
                    <option value="নন প্রফিটেবল অর্গানাইজেশন"
                        {{ old('organization_type') == 'নন প্রফিটেবল অর্গানাইজেশন' ? 'selected' : '' }}>নন প্রফিটেবল
                        অর্গানাইজেশন</option>
                    <option value="রক্তদাতা সংগঠন"
                        {{ old('organization_type') == 'রক্তদাতা সংগঠন' ? 'selected' : '' }}>রক্তদাতা সংগঠন</option>
                    <option value="ডিজিটাল প্রিন্টিং পেস"
                        {{ old('organization_type') == 'ডিজিটাল প্রিন্টিং পেস' ? 'selected' : '' }}>ডিজিটাল প্রিন্টিং
                        পেস</option>
                    <option value="কৃষি / এগ্রোফার্ম"
                        {{ old('organization_type') == 'কৃষি / এগ্রোফার্ম' ? 'selected' : '' }}>কৃষি / এগ্রোফার্ম
                    </option>
                    <option value="ক্লোথিং ব্র্যান্ড"
                        {{ old('organization_type') == 'ক্লোথিং ব্র্যান্ড' ? 'selected' : '' }}>ক্লোথিং ব্র্যান্ড
                    </option>
                    <option value="রিয়েল স্টেট" {{ old('organization_type') == 'রিয়েল স্টেট' ? 'selected' : '' }}>রিয়েল
                        স্টেট</option>
                    <option value="রেট্রো" {{ old('organization_type') == 'রেট্রো' ? 'selected' : '' }}>রেট্রো</option>
                    <option value="মডার্ন" {{ old('organization_type') == 'মডার্ন' ? 'selected' : '' }}>মডার্ন</option>
                    <option value="ক্যালিগ্রাফি" {{ old('organization_type') == 'ক্যালিগ্রাফি' ? 'selected' : '' }}>
                        ক্যালিগ্রাফি</option>
                    <option value="থ্রি-ডি" {{ old('organization_type') == 'থ্রি-ডি' ? 'selected' : '' }}>থ্রি-ডি
                    </option>
                </select>
                @error('organization_type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium mb-1">প্রতিষ্ঠানের স্লোগান/ক্যাপশান (যদি থাকে)</label>
                <input type="text" name="slogan" value="{{ old('slogan') }}"
                    class="w-full border border-gray-300 rounded p-2">
                @error('slogan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div>
                <label class="block font-medium mb-1">কলার পছন্দ অনুযায়ী (একাধিক সিলেক্ট করুন)</label>
                <div class="grid grid-cols-2 gap-2">
                    <label>
                        <input type="checkbox" name="color_preference[]" value="কালো" class="mr-2"
                            {{ is_array(old('color_preference')) && in_array('কালো', old('color_preference')) ? 'checked' : '' }}>
                        কালো
                    </label>
                    <label>
                        <input type="checkbox" name="color_preference[]" value="সাদা" class="mr-2"
                            {{ is_array(old('color_preference')) && in_array('সাদা', old('color_preference')) ? 'checked' : '' }}>
                        সাদা
                    </label>
                    <label>
                        <input type="checkbox" name="color_preference[]" value="লাল" class="mr-2"
                            {{ is_array(old('color_preference')) && in_array('লাল', old('color_preference')) ? 'checked' : '' }}>
                        লাল
                    </label>
                    <label>
                        <input type="checkbox" name="color_preference[]" value="নীল" class="mr-2"
                            {{ is_array(old('color_preference')) && in_array('নীল', old('color_preference')) ? 'checked' : '' }}>
                        নীল
                    </label>
                    <label>
                        <input type="checkbox" name="color_preference[]" value="সবুজ" class="mr-2"
                            {{ is_array(old('color_preference')) && in_array('সবুজ', old('color_preference')) ? 'checked' : '' }}>
                        সবুজ
                    </label>
                    <label>
                        <input type="checkbox" name="color_preference[]" value="হলুদ" class="mr-2"
                            {{ is_array(old('color_preference')) && in_array('হলুদ', old('color_preference')) ? 'checked' : '' }}>
                        হলুদ
                    </label>
                    <label>
                        <input type="checkbox" name="color_preference[]" value="Other" class="mr-2"
                            {{ is_array(old('color_preference')) && in_array('Other', old('color_preference')) ? 'checked' : '' }}>
                        Other
                    </label>
                </div>
                @error('color_preference')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div>
                <label class="block font-medium mb-1">কি ধরণের লোগো প্রত্যাশা করছেন <span>*</span></label>
                <select name="logo_type" class="w-full border border-gray-300 rounded p-2">
                    <option value="">-- বাছাই করুন --</option>
                    <option value="3D" {{ old('logo_type') == '3D' ? 'selected' : '' }}>3D</option>
                    <option value="Flat" {{ old('logo_type') == 'Flat' ? 'selected' : '' }}>Flat</option>
                    <option value="Minimal" {{ old('logo_type') == 'Minimal' ? 'selected' : '' }}>Minimal</option>
                </select>
                @error('logo_type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div>
                <label class="block font-medium mb-1">
                    লোগোর সাথে আর কি কি প্রয়োজন (শুধুমাত্র এডভান্স/প্রিমিয়াম প্যাকেজ)? <span>*</span>
                </label>
                <select name="additional_logo_services" class="w-full border border-gray-300 rounded p-2">
                    <option value="">-- বাছাই করুন --</option>
                    <option value="ফেইসবুক/ সোস্যাল মিডিয়া কভার ইমেজ"
                        {{ old('additional_logo_services') == 'ফেইসবুক/ সোস্যাল মিডিয়া কভার ইমেজ' ? 'selected' : '' }}>
                        ফেইসবুক/ সোস্যাল মিডিয়া কভার ইমেজ
                    </option>
                    <option value="থ্রিডি মোকআপ JPG"
                        {{ old('additional_logo_services') == 'থ্রিডি মোকআপ JPG' ? 'selected' : '' }}>
                        থ্রিডি মোকআপ JPG
                    </option>
                    <option value="থ্রিডি ইন্ট্রো/আউট্রো (Charged for Basic)"
                        {{ old('additional_logo_services') == 'থ্রিডি ইন্ট্রো/আউট্রো (Charged for Basic)' ? 'selected' : '' }}>
                        থ্রিডি ইন্ট্রো/আউট্রো (Charged for Basic)
                    </option>
                    <option value="থ্রিডি ইন্ট্রো"
                        {{ old('additional_logo_services') == 'থ্রিডি ইন্ট্রো' ? 'selected' : '' }}>
                        থ্রিডি ইন্ট্রো
                    </option>
                </select>
                @error('additional_logo_services')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div>
                <label class="block font-medium mb-1">কি ধরনের ফাইল ফরম্যাট আপনি চান?</label>
                <div class="grid grid-cols-2 gap-2">
                    <label>
                        <input type="checkbox" name="file_formats[]" value="AI (Illustrator)" class="mr-2"
                            {{ in_array('AI (Illustrator)', old('file_formats', [])) ? 'checked' : '' }}>
                        AI (Illustrator)
                    </label>
                    <label>
                        <input type="checkbox" name="file_formats[]" value="PSD" class="mr-2"
                            {{ in_array('PSD', old('file_formats', [])) ? 'checked' : '' }}>
                        PSD
                    </label>
                    <label>
                        <input type="checkbox" name="file_formats[]" value="SVG" class="mr-2"
                            {{ in_array('SVG', old('file_formats', [])) ? 'checked' : '' }}>
                        SVG
                    </label>
                    <label>
                        <input type="checkbox" name="file_formats[]" value="PDF" class="mr-2"
                            {{ in_array('PDF', old('file_formats', [])) ? 'checked' : '' }}>
                        PDF
                    </label>
                    <label>
                        <input type="checkbox" name="file_formats[]" value="JPG" class="mr-2"
                            {{ in_array('JPG', old('file_formats', [])) ? 'checked' : '' }}>
                        JPG
                    </label>
                    <label>
                        <input type="checkbox" name="file_formats[]" value="PNG (Transparent)" class="mr-2"
                            {{ in_array('PNG (Transparent)', old('file_formats', [])) ? 'checked' : '' }}>
                        PNG (Transparent)
                    </label>
                </div>
                @error('file_formats')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div>
                <label class="block font-medium mb-1">আপনার বর্তমান পেশা অথবা নতুন উদ্যোক্তা হলে উল্লেখ করুন।</label>
                <input type="text" name="occupation" class="w-full border border-gray-300 rounded p-2"
                    value="{{ old('occupation') }}">
                @error('occupation')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium mb-1">আরও কোন ছবি বা ড্রাফট স্কেচ থাকলে শেয়ার করুন</label>
                <input type="file" name="image_or_draft" class="w-full border border-gray-300 rounded p-2">
                @error('image_or_draft')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium mb-1">আরও কোন তথ্য শেয়ার করতে লিখুন</label>
                <input type="text" name="additional_info" class="w-full border border-gray-300 rounded p-2"
                    value="{{ old('additional_info') }}">
                @error('additional_info')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium mb-1">এডভান্স পেমেন্ট <span>*</span></label>
                <select name="advance_payment" class="w-full border border-gray-300 rounded p-2">
                    <option value="">-- বাছাই করুন --</option>
                    @foreach (['১০০০/-', '১৫০০/-', '২০০০/-', '২৫০০/-', '৩০০০/-', '৩৫০০/-', '৪০০০/-', '৪৫০০/-', '৫০০০/-'] as $amount)
                        <option value="{{ $amount }}"
                            {{ old('advance_payment') == $amount ? 'selected' : '' }}>{{ $amount }}</option>
                    @endforeach
                </select>
                @error('advance_payment')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium mb-1">পেমেন্ট অপশন <span>*</span></label>
                <select name="payment_option" class="w-full border border-gray-300 rounded p-2">
                    <option value="">-- বাছাই করুন --</option>
                    @foreach (['বিকাশ  (P) - 01672034770', 'নগদ  (P) - 01629595157', 'রকেট  (P) - 019456780710', 'Tap (Trust Bank) - 01629595157', 'Bank Transfer (Contact for Details)'] as $option)
                        <option value="{{ $option }}" {{ old('payment_option') == $option ? 'selected' : '' }}>
                            {{ $option }}</option>
                    @endforeach
                </select>
                @error('payment_option')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium mb-1">যে নাম্বার থেকে সেন্ড মানি করেছেন সে নাম্বারটি লিখুন
                    <span>*</span></label>
                <input type="text" name="transaction_number" class="w-full border border-gray-300 rounded p-2"
                    value="{{ old('transaction_number') }}">
                @error('transaction_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium mb-1">সেন্ডমানি ট্রানজেকশান (স্ক্রিনশট)</label>
                <input type="file" name="transaction_screenshot"
                    class="w-full border border-gray-300 rounded p-2">
                @error('transaction_screenshot')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium mb-1">রেফারেন্সে আপনার প্রতিষ্ঠানের নামটি উল্লেখ করুন</label>
                <input type="text" name="reference_name" class="w-full border border-gray-300 rounded p-2"
                    value="{{ old('reference_name') }}">
                @error('reference_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium mb-1">অন্যসকল সেবা সমূহ পেতে আগ্রহী?</label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach (['প্রিন্টিং ডিজাইন', 'Into Video', 'লোগো এনিমেশন', 'ওয়েব ডেভেলপমেন্ট', 'ওয়েব ডিজাইন', 'Digital Marketing', 'Facebook Boosting'] as $service)
                        <label>
                            <input type="checkbox" name="services[]" value="{{ $service }}" class="mr-2"
                                {{ is_array(old('services')) && in_array($service, old('services')) ? 'checked' : '' }}>
                            {{ $service }}
                        </label>
                    @endforeach
                </div>
                @error('services')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <div class="text-sm mt-2">
                    বিস্তারিত জানতে চোখ রাখুন: <a href="http://www.adarshalipi.com" class="text-blue-600"
                        target="_blank">www.adarshalipi.com</a>
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white rounded p-2 w-full">Submit</button>
        </form>
    </div>
</body>

</html>
