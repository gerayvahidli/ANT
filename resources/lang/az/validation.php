<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	'accepted'             => 'The :attribute must be accepted.',
	'active_url'           => 'The :attribute is not a valid URL.',
	'after'                => 'The :attribute must be a date after :date.',
	'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
	'alpha'                => 'The :attribute may only contain letters.',
	'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
	'alpha_num'            => 'The :attribute may only contain letters and numbers.',
	'array'                => 'The :attribute must be an array.',
	'before'               => 'The :attribute must be a date before :date.',
	'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
	'between'              => [
		'numeric' => 'The :attribute must be between :min and :max.',
		'file'    => 'The :attribute must be between :min and :max kilobytes.',
		'string'  => 'The :attribute must be between :min and :max characters.',
		'array'   => 'The :attribute must have between :min and :max items.',
	],
	'boolean'              => 'The :attribute field must be true or false.',
	'confirmed'            => ':attribute təkrarla xanası ilə uyğun deyil.',
	'date'                 => ':attribute -düzgün tarix formatında deyil.',
	'date_format'          => ':attribute xanası, :format - formatında deyil.',
	'different'            => 'The :attribute and :other must be different.',
	'digits'               => ' :attribute :digits rəqəm olmalıdır.',
	'digits_between'       => 'The :attribute must be between :min and :max digits.',
	'dimensions'           => 'The :attribute has invalid image dimensions.',
	'distinct'             => 'The :attribute field has a duplicate value.',
	'email'                => ':attribute düzgün e-mail adress formasında olmalıdır.',
	'exists'               => 'The selected :attribute is invalid.',
	'file'                 => ':attribute xanasına fayl əlavə edin.',
	'filled'               => 'The :attribute field must have a value.',
	'image'                => ':attribute -xanası şəkil formatında olmalıdır.',
	'in'                   => 'The selected :attribute is invalid.',
	'in_array'             => 'The :attribute field does not exist in :other.',
	'integer'              => ':attribute xanası rəqəm olmalıdır.',
	'ip'                   => 'The :attribute must be a valid IP address.',
	'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
	'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
	'json'                 => 'The :attribute must be a valid JSON string.',
	'max'                  => [
		'numeric' => ':attribute xanasına daxil edilmiş məlumatın uzunluğu :max -dan çox ola bilməz.',
		'file'    => 'The :attribute may not be greater than :max kilobytes.',
		'string'  => ':attribute xanasına daxil edilmiş məlumatın uzunluğu :max -dan çox ola bilməz.',
		'array'   => 'The :attribute may not have more than :max items.',
	],
	'mimes'                => ':attribute xanasına daxil edilmiş məlumat: :values -formatında ola bilər.',
	'mimetypes'            => 'The :attribute must be a file of type: :values.',
	'min'                  => [
		'numeric' => ':attribute xanasına daxil edilmiş məlumatın uzunluğu :min -dən az ola bilməz.',
		'file'    => 'The :attribute must be at least :min kilobytes.',
		'string'  => 'The :attribute xanasına daxil edilmiş məlumatın uzunluğu :min -dən az ola bilməz.',
		'array'   => 'The :attribute must have at least :min items.',
	],
	'not_in'               => 'The selected :attribute is invalid.',
	'not_regex'            => 'The :attribute format is invalid.',
	'numeric'              => 'The :attribute must be a number.',
	'present'              => 'The :attribute field must be present.',
	'regex'                => 'The :attribute format is invalid.',
	'required'             => 'Bu sahəni boş buraxmayın!',
	'required_if'          => 'The :attribute field is required when :other is :value.',
	'required_unless'      => 'The :attribute field is required unless :other is in :values.',
	'required_with'        => 'The :attribute field is required when :values is present.',
	'required_with_all'    => 'The :attribute field is required when :values is present.',
	'required_without'     => 'The :attribute field is required when :values is not present.',
	'required_without_all' => 'The :attribute field is required when none of :values are present.',
	'same'                 => 'The :attribute and :other must match.',
	'size'                 => [
		'numeric' => 'The :attribute must be :size.',
		'file'    => 'The :attribute must be :size kilobytes.',
		'string'  => 'The :attribute must be :size characters.',
		'array'   => 'The :attribute must contain :size items.',
	],
	'string'               => ':attribute xanası sətir formatında olmalıdır.',
	'timezone'             => 'The :attribute must be a valid zone.',
	'unique'               => /*':attribute xanasına daxil edilmiş məlumat unikal olmalıdır.',*/
		'Bu email ilə artıq qeydiyyatdan keçilib.',
	'uploaded'             => 'The :attribute failed to upload.',
	'url'                  => 'The :attribute format is invalid.',

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'image'                => [
			'required' => 'Şəkil xanası boş ola bilməz!',
			'image'    => 'Şəkil -xanası şəkil formatında olmalıdır.',
			'mimes'    => 'Şəkil xanasına daxil edilmiş məlumat: :values -formatında ola bilər.',
		],
		'FirstName'            => [
			'required' => 'Ad xanası boş ola bilməz!',
			'string'   => 'Ad xanası sətir formatında olmalıdır!',
			'max'      => [
				'numeric' => 'Ad xanasına daxil edilmiş məlumatın uzunluğu :max -dan çox ola bilməz.',
				'file'    => 'The Ad may not be greater than :max kilobytes.',
				'string'  => 'Ad xanasına daxil edilmiş məlumatın uzunluğu :max -dan çox ola bilməz.',
				'array'   => 'The Ad may not have more than :max items.',
			],
		],
		'LastName'             => [
			'required' => 'Soyad xanası boş ola bilməz!',
			'string'   => 'Soyad xanası sətir formatında olmalıdır!',
			'max'      => [
				'numeric' => 'Soyad xanasına daxil edilmiş məlumatın uzunluğu :max -dan çox ola bilməz.',
				'file'    => 'The Soyad may not be greater than :max kilobytes.',
				'string'  => 'Soyad xanasına daxil edilmiş məlumatın uzunluğu :max -dan çox ola bilməz.',
				'array'   => 'The Soyad may not have more than :max items.',
			],
		],
		'FatherName'           => [
			'required' => 'Ata adı xanası boş ola bilməz!',
			'string'   => 'Ata adı xanası sətir formatında olmalıdır!',
			'max'      => [
				'numeric' => 'Ata adı xanasına daxil edilmiş məlumatın uzunluğu :max -dan çox ola bilməz.',
				'file'    => 'The Ata adı may not be greater than :max kilobytes.',
				'string'  => 'Ata adı xanasına daxil edilmiş məlumatın uzunluğu :max -dan çox ola bilməz.',
				'array'   => 'The Ata adı may not have more than :max items.',
			],
		],
		'mobilePhone.*.number' => [
			'digits' => 'Telefon nömrəsi xanası :digits rəqəmdən ibarət olmalıdır.',
		],
		'email'                => [
			'required' => 'Email xanası boş ola bilməz!',
			'string'   => 'Email xanası sətir formatında olmalıdır!',
			'email'    => 'Email düzgün e-mail adress formasında olmalıdır.',

			'max' => [
				'numeric' => 'Email xanasına daxil edilmiş məlumatın uzunluğu :max -dan çox ola bilməz.',
				'file'    => 'The Email may not be greater than :max kilobytes.',
				'string'  => 'Email xanasına daxil edilmiş məlumatın uzunluğu :max -dan çox ola bilməz.',
				'array'   => 'The Email may not have more than :max items.',
			],
		],

		'password' => [
			'required'  => 'Şifrə xanası boş ola bilməz!',
			'string'    => 'Şifrə xanası sətir formatında olmalıdır!',
			'confirmed' => 'Şifrə xanası (şifrəni) təkrarla xanası ilə uyğun deyil.',
			'min'       => [
				'numeric' => 'Şifrə xanasına daxil edilmiş məlumatın uzunluğu :min -dən az ola bilməz.',
				'file'    => 'The :attribute must be at least :min kilobytes.',
				'string'  => 'Şifrə xanasına daxil edilmiş məlumatın uzunluğu :min -dən az ola bilməz.',
				'array'   => 'The :attribute must have at least :min items.',
			],
			'max'       => [
				'numeric' => 'Şifrə xanasına daxil edilmiş məlumatın uzunluğu :max -dan çox ola bilməz.',
				'file'    => 'The Şifrə may not be greater than :max kilobytes.',
				'string'  => 'Şifrə xanasına daxil edilmiş məlumatın uzunluğu :max -dan çox ola bilməz.',
				'array'   => 'The Şifrə may not have more than :max items.',
			],
            'regex'                => ':attribute formatı yanlışdır. Rəqəmlər, böyük kicik hərflərdən
                                       və xüsusi simvollardan(@$!%*#?&) istifadə edin.',
		],

		'nationality' => [
			'required' => 'Vətəndaşlığı xanası boş ola bilməz!',
		],

		'dateOfBirth' => [
			'required' => 'Təvəllüd xanası boş ola bilməz!',
			'date'     => 'Təvəllüd xanası düzgün tarix formatında deyil!',
			'before'   => 'Təvəllüd xanasında olan məlumat :date tarixindən əvvəl olmalıdır.',
			'after'    => 'Təvəllüd xanasında olan məlumat :date. tarixindən sonra olmalıdır.',
		],
		'City_id'     => [
			'required' => 'Anadan olduğu yer xanası boş ola bilməz!',
		],

		'custom_city' => [
			'required' => 'Anadan olduğu şəhər xanası boş ola bilməz!',
			'string'   => 'Anadan olduğu şəhər xanası sətir formatında olmalıdır!',
		],

		'Address' => [
			'required' => 'Ünvan xanası boş ola bilməz!',
			'string'   => 'Ünvan xanası sətir formatında olmalıdır!',
		],

		'idCardNumber' => [
			'required' => 'Şəxsiyyət vəsiqəsinin nömrəsi xanası boş ola bilməz!',
			'string'   => 'Şəxsiyyət vəsiqəsinin nömrəsi xanası sətir formatında olmalıdır!',
			'size'     => [
				'numeric' => 'əxsiyyət vəsiqəsinin nömrəsi :size rəqəmdən ibarət olmalıdır.',
				'file'    => 'The :attribute must be :size kilobytes.',
				'string'  => 'Şəxsiyyət vəsiqəsinin nömrəsi :size simvol olmalıdır.',
				'array'   => 'The :attribute must contain :size items.',
			],
			'min'       => [
				'numeric' => 'Şəxsiyyət vəsiqəsinin nömrəsi xanasına daxil edilmiş məlumatın uzunluğu :min -dən az ola bilməz.',
				'file'    => 'The :attribute must be at least :min kilobytes.',
				'string'  => 'Şəxsiyyət vəsiqəsinin nömrəsi xanasına daxil edilmiş məlumatın uzunluğu :min -dən az ola bilməz.',
				'array'   => 'The :attribute must have at least :min items.',
			],
		],

		'idCardPin' => [
			'required' => 'Şəxsiyyət vəsiqəsinin FİN kodu xanası boş ola bilməz!',
			'string'   => 'Şəxsiyyət vəsiqəsinin FİN kodu xanası sətir formatında olmalıdır!',
			'size'     => [
				'numeric' => 'The :attribute must be :size.',
				'file'    => 'The :attribute must be :size kilobytes.',
				'string'  => 'Şəxsiyyət vəsiqəsinin FİN kodu :size simvol olmalıdır.',
				'array'   => 'The :attribute must contain :size items.',
			],
		],

		'MaidenSurname'   => [
			'required' => 'Anasının qızlıq soyadı xanası boş ola bilməz!',
			'string'   => 'Anasının qızlıq soyadı xanası sətir formatında olmalıdır!',
		],

		// final education
		'education_level' => [
			'required' => 'Son təhsil bölməsində təhsil pilləsi xanası boş ola bilməz!',
		],

		'country_id' => [
			'required' => 'Son təhsil bölməsində təhsil aldığı ölkə xanası boş ola bilməz!',
			'integer'  => 'Son təhsil bölməsində təhsil aldığı ölkə xanası düzgün seçilməyib.',
		],

		'university_id' => [
			'required' => 'Son təhsil bölməsində təhsil aldığı universitet xanası boş ola bilməz!',
			'integer'  => 'Son təhsil bölməsində təhsil aldığı universitet xanası düzgün seçilməyib.',
		],

		'BeginDate' => [
			'required' => 'Son təhsil bölməsində başlanğıc tarix xanası boş ola bilməz!',
			'date'     => 'Son təhsil bölməsində başlanğıc tarix düzgün tarix formatında deyil.',
			'before'   => 'Son təhsil bölməsində başlanğıc tarix :date tarixindən əvvəl olmalıdır.',
			'after'    => 'Son təhsil bölməsində başlanğıc tarix :date tarixindən sonra olmalıdır.',
		],

		'EndDate' => [
			'required' => 'Son təhsil bölməsində son tarix xanası boş ola bilməz!',
			'date'     => 'Son təhsil bölməsində son tarix düzgün tarix formatında deyil.',
			'before'   => 'Son təhsil bölməsində son tarix :date tarixindən əvvəl olmalıdır.',
			'after'    => 'Son təhsil bölməsində son tarix :date tarixindən sonra olmalıdır.',
		],

		'current_edu_year' => [
			'required' => 'Kurs xanası boş ola bilməz!',
			'integer'  => 'Kurs xanası rəqəm olmalıdır.',
		],

		'faculty' => [
			'required' => 'Fakültə xanası boş ola bilməz!',
			'string'   => 'Fakültə sətir formatında olmalıdır!',
		],

		'speciality' => [
			'required' => 'İxtisas xanası boş ola bilməz!',
			'string'   => 'İxtisas sətir formatında olmalıdır!',
		],

		'admission_score' => [
			'required' => 'Qəbul balı xanası boş ola bilməz!',
			'integer'  => 'Qəbul balı xanası yalnız rəqəmlərdən(ədəd) ibarət ola bilər.',
			'between'  => [
				'numeric' => 'Qəbul balı xanası :min - :max aralığında olmalıdır.',
				'file'    => 'The :attribute must be between :min and :max kilobytes.',
				'string'  => 'Qəbul balı xanası :min - :max aralığında olmalıdır.',
				'array'   => 'The :attribute must have between :min and :max items.',
			],
		],

		'education_section_id' => [
			'required' => 'Bölmə xanası boş ola bilməz!',
			'integer'  => 'Bölmə xanası rəqəm olmalıdır.',
		],

		'education_section' => [
			'required' => 'Bölməni daxil edin xanası boş ola bilməz!',
			'string'   => 'Bölmə daxil edin xanası sətir formatında olmalıdır.',
		],

		'education_form_id' => [
			'required' => 'Təhsil forması xanası boş ola bilməz!',
			'integer'  => 'Təhsil forması xanası düzgün seçilməyib.',
		],

		'education_payment_form_id' => [
			'required' => 'Təhsil qrupu xanası boş ola bilməz!',
			'integer'  => 'Təhsil qrupu xanası düzgün seçilməyib.',
		],

		// previous education
		'previous_education_level'  => [
			'required' => 'Əvvəlki təhsil bölməsində Təhsil Pilləsi xanası boş ola bilməz!',
			'integer'  => 'Əvvəlki təhsil bölməsində Təhsil Pilləsi düzgün seçilməyib.',
		],

		'previous_education_country_id' => [
			'required' => 'Əvvəlki təhsil bölməsində təhsil aldığı ölkə xanası boş ola bilməz!',
			'integer'  => 'Əvvəlki təhsil bölməsində təhsil aldığı ölkə xanası düzgün seçilməyib.',
		],

		'previous_education_university_id' => [
			'required' => 'Əvvəlki təhsil bölməsində təhsil aldığı universitet xanası boş ola bilməz!',
			'integer'  => 'Əvvəlki təhsil bölməsində təhsil aldığı universitet xanası düzgün seçilməyib.',
		],

		'previous_education_BeginDate.*' => [
			'required' => 'Əvvəlki təhsil bölməsində başlanğıc tarix xanası boş ola bilməz!',
			'date'     => 'Əvvəlki təhsil bölməsində başlanğıc tarix düzgün tarix formatında deyil.',
			'before'   => 'Əvvəlki təhsil bölməsində başlanğıc tarix :date tarixindən əvvəl olmalıdır.',
			'after'    => 'Əvvəlki təhsil bölməsində başlanğıc tarix :date tarixindən sonra olmalıdır.',
		],

		'previous_education_EndDate.*' => [
			'required' => 'Əvvəlki təhsil bölməsində son tarix xanası boş ola bilməz!',
			'date'     => 'Əvvəlki təhsil bölməsində son tarix düzgün tarix formatında deyil.',
			'before'   => 'Əvvəlki təhsil bölməsində son tarix :date tarixindən əvvəl olmalıdır.',
			'after'    => 'Əvvəlki təhsil bölməsində son tarix :date tarixindən sonra olmalıdır.',
		],

		'previous_education_speciality.*' => [
			'required' => 'Əvvəlki təhsil bölməsində İxtisas xanası boş ola bilməz!',
			'string'   => 'Əvvəlki təhsil bölməsində İxtisas xanası sətir formatında olmalıdır!',
		],

		'previous_education_admission_score' => [
			'required' => 'Əvvəlki təhsil bölməsində Qəbul balı xanası boş ola bilməz!',
			'integer'  => 'Əvvəlki təhsil bölməsində Qəbul balı xanası yalnız rəqəmlərdən(ədəd) ibarət ola bilər.',
			'between'  => [
				'numeric' => 'Əvvəlki təhsil bölməsində Qəbul balı xanası :min - :max aralığında olmalıdır.',
				'file'    => 'The :attribute must be between :min and :max kilobytes.',
				'string'  => 'Əvvəlki təhsil bölməsində Qəbul balı xanası :min - :max aralığında olmalıdır.',
				'array'   => 'The :attribute must have between :min and :max items.',
			],
		],

		// work
		'is_currently_working'               => [
			'required' => 'Hazırda işləyirsinizmi xanası boş ola bilməz!',
			'boolean'  => 'Hazırda işləyirsinizmi xanası bəli və ya xeyr ola bilər.',
		],

		'is_currently_working_at_socar' => [
			'required' => 'SOCAR əməkdaşısınızmı xanası boş ola bilməz!',
			'boolean'  => 'SOCAR əməkdaşısınızmı xanası bəli və ya xeyr ola bilər.',
		],

		'personal_number' => [
			'required' => 'Tabel nömrəniz xanası boş ola bilməz!',
			'string'   => 'Tabel nömrəniz sətir formatında olmalıdır!',
		],

		'work_company' => [
			'string' => 'Müəssisə və ya təşkilat sətir formatında olmalıdır!',
		],

		'work_experience'         => [
			'integer' => 'İş stajınız xanası rəqəm olmalıdır.',
		],

		// scholarship
		'hasAppliedToScholarship' => [
			'required' => 'Əvvəlki illərdə təqaüd müsabiqəsində iştirak etmisinizmi xanası boş ola bilməz!',
			'boolean'  => 'Əvvəlki illərdə təqaüd müsabiqəsində iştirak etmisinizmi  bəli və ya xeyr ola bilər.',
		],

		'haveBeenScholar' => [
			'required' => 'Təqaüdçü olmusunuzmu xanası boş ola bilməz!',
			'boolean'  => 'Təqaüdçü olmusunuzmu xanası bəli və ya xeyr ola bilər.',
		],

		'previous_scholarship_type' => [
			'required' => 'Təqaüd növü xanası boş ola bilməz!',
			'integer'  => 'Təqaüd növü xanası düzgün seçilməyib.',
		],

		'previous_scholarship_date.*' => [
			'required' => 'Təqaüd tarixi xanası boş ola bilməz!',
			'date'     => 'Təqaüd tarixi düzgün tarix formatında deyil.',
			'before'   => 'Təqaüd tarixi :date tarixindən əvvəl olmalıdır.',
			'after'    => 'Təqaüd tarixi :date tarixindən sonra olmalıdır.',
		],

		// internship
		'haveBeenIntern'              => [
			'required' => 'Ödənişli təcrübə proqramı çərçivəsində SOCAR-da təcrübə keçmisinizmi xanası boş ola bilməz!',
			'boolean'  => 'Ödənişli təcrübə proqramı çərçivəsində SOCAR-da təcrübə keçmisinizmi xanası bəli və ya xeyr ola bilər.',
		],

		'internship_department.*' => [
			'string' => 'Təcrübə keçdiyiniz müəssisə xanası sətir formatında olmalıdır!',
			'max'    => [
				'numeric' => 'Email xanasına daxil edilmiş məlumatın uzunluğu :max -dan çox ola bilməz.',
				'file'    => 'The Email may not be greater than :max kilobytes.',
				'string'  => 'Təcrübə keçdiyiniz müəssisə xanasına daxil edilmiş məlumatın uzunluğu :max -dan çox ola bilməz.',
				'array'   => 'The Email may not have more than :max items.',
			],
		],

		'internship_date.*' => [
			'date'   => 'Təcrübə keçdiyiniz tarix düzgün tarix formatında deyil.',
			'before' => 'Təcrübə keçdiyiniz tarix :date tarixindən əvvəl olmalıdır.',
			'after'  => 'Təcrübə keçdiyiniz tarixi :date tarixindən sonra olmalıdır.',
		],

		// exam language
		'exam_language_id'  => [
			'required' => 'İmtahanı dili xanası boş ola bilməz!',
			'integer'  => 'İmtahanı dili xanası düzgün seçilməyib.',
		],

	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [
		'specialty_name'                       => 'İxtisas',
		'country_id'                           => 'Ölkə',
		'city_name'                            => 'Şəhər',
		'main_modules'                         => 'Əsas modullar',
		'EducationBeginDate'                   => 'Başlama tarixi',
		'EducationEndDate'                     => 'Bitmə tarixi',
		'education_fee'                        => 'Təhsil haqqı',
		'language_education_certificate_score' => 'Bal',
		'located_city'                         => 'Yerləşdiyi şəhər',
		'work_experience_details'              => 'İş təcrübəsi',
		'about_family'                         => 'Ailəsi haqqında',
		'City_id'                              => 'Anadan olduğu yer',
		'nationality'                          => 'Vətəndaşlığı',
		'Address'                              => 'Ünvan',
		'idCardNumber'                         => 'Şəxsiyyət vəsiqəsinin nömrəsi',
		'idCardPin'                            => 'Şəxsiyyət vəsiqəsinin FİN kodu',
		'MaidenSurname'                        => 'Anasının qızlıq soyadı',
		'is_currently_working'                 => 'Hazırda işləyirsinizmi?',
		'work_company'                         => 'Müəssisə və ya təşkilat',
		'work_experience'                      => 'İş stajınız',
		'exam_language_id'                     => 'İmtahanı hansı dildə verə bilərsiniz',
		'BeginDate'                            => 'Təhsil müddəti - başlanğıc tarixi',
		'EndDate'                              => 'Təhsil müddəti - bitirmə tarixi',
		'current_edu_year'                     => 'Kurs',
		'faculty'                              => 'Fakültə',
		'speciality'                           => 'İxtisas',
		'admission_score'                      => 'Qəbul balı',
		'previous_education_BeginDate'         => 'Əvvəlki təhsil bölməsində başlanğıc tarixi',
		'previous_education_EndDate'           => 'Əvvəlki təhsil bölməsində bitirmə tarixi',
		'mobilePhone.*.number'                 => 'Telefon nömrəsi',
        'password'                             => 'Şifrə',


	],

];
