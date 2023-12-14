<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Department;

class UserFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $department = Department::inRandomOrder()->first();
        return [
            'username' => $this->faker->userName,
            'surname' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => $this->faker->randomElement(['employee']),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'date_of_birth' => $this->faker->date,
            'civil_status' => $this->faker->randomElement(['single', 'married', 'separated', 'widowed']),
            'height' => $this->faker->randomFloat(2, 150, 200),
            'weight' => $this->faker->randomNumber(2, false),
            'blood_type' => $this->faker->randomElement(['A+', 'B+', 'AB+', 'O+', 'A-', 'B-', 'AB-', 'O-']),
            'sss_id_no' => $this->faker->numerify('#########'),
            'pag_ibig_id_no' => $this->faker->numerify('#########'),
            'philhealth_no' => $this->faker->numerify('#########'),
            'tin_no' => $this->faker->numerify('#########'),
            'mdc_id' => $this->faker->numerify('MD######'),
            'place_of_birth' => $this->faker->city,
            'residential_house_no' => $this->faker->buildingNumber,
            'residential_street' => $this->faker->streetName,
            'residential_subdivision' => $this->faker->word,
            'residential_barangay' => $this->faker->word,
            'residential_city' => $this->faker->city,
            'residential_province' => $this->faker->state,
            'residential_zip_code' => $this->faker->postcode,
            'permanent_house_no' => $this->faker->buildingNumber,
            'permanent_street' => $this->faker->streetName,
            'permanent_subdivision' => $this->faker->word,
            'permanent_barangay' => $this->faker->word,
            'permanent_city' => $this->faker->city,
            'permanent_province' => $this->faker->state,
            'permanent_zip_code' => $this->faker->postcode,
            'telephone_number' => $this->faker->phoneNumber,
            'mobile_number' => $this->faker->phoneNumber,
            'messenger_account' => $this->faker->userName,
            'spouse_surname' => $this->faker->lastName,
            'spouse_first_name' => $this->faker->firstName,
            'spouse_name_extension' => $this->faker->suffix,
            'spouse_middle_name' => $this->faker->firstName,
            'spouse_occupation' => $this->faker->word,
            'spouse_employer' => $this->faker->company,
            'spouse_business_address' => $this->faker->address,
            'spouse_telephone' => $this->faker->phoneNumber,
            'father_surname' => $this->faker->lastName,
            'father_first_name' => $this->faker->firstName,
            'father_name_extension' => $this->faker->suffix,
            'father_middle_name' => $this->faker->firstName,
            'mother_maiden_surname' => $this->faker->lastName,
            'mother_first_name' => $this->faker->firstName,
            'mother_middle_name' => $this->faker->firstName,
            'elementary_school' => $this->faker->sentence,
            'elementary_degree' => $this->faker->sentence,
            'elementary_attendance_from' => $this->faker->date,
            'elementary_attendance_to' => $this->faker->date,
            'elementary_highest_level' => $this->faker->sentence,
            'elementary_year_graduated' => $this->faker->date,
            'elementary_honors' => $this->faker->sentence,

            'secondary_school' => $this->faker->sentence,
            'secondary_degree' => $this->faker->sentence,
            'secondary_attendance_from' => $this->faker->date,
            'secondary_attendance_to' => $this->faker->date,
            'secondary_highest_level' => $this->faker->sentence,
            'secondary_year_graduated' => $this->faker->date,
            'secondary_honors' => $this->faker->sentence,

            'vocational_school' => $this->faker->sentence,
            'vocational_degree' => $this->faker->sentence,
            'vocational_attendance_from' => $this->faker->date,
            'vocational_attendance_to' => $this->faker->date,
            'vocational_highest_level' => $this->faker->sentence,
            'vocational_year_graduated' => $this->faker->date,
            'vocational_honors' => $this->faker->sentence,

            'college_school' => $this->faker->sentence,
            'college_degree' => $this->faker->sentence,
            'college_attendance_from' => $this->faker->date,
            'college_attendance_to' => $this->faker->date,
            'college_highest_level' => $this->faker->sentence,
            'college_year_graduated' => $this->faker->date,
            'college_honors' => $this->faker->sentence,

            'graduate_school' => $this->faker->sentence,
            'graduate_degree' => $this->faker->sentence,
            'graduate_attendance_from' => $this->faker->date,
            'graduate_attendance_to' => $this->faker->date,
            'graduate_highest_level' => $this->faker->sentence,
            'graduate_year_graduated' => $this->faker->date,
            'graduate_honors' => $this->faker->sentence,
            'date' => $this->faker->date,
            'department_id' => $department->id,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
