<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Seed realistic Lagos shortlet listings.
     */
    public function run(): void
    {
        $listings = [
            [
                'title' => 'Serviced 2-bedroom on Admiralty Way',
                'area' => 'Lekki',
                'price_per_night' => 95000,
                'bedrooms' => 2,
                'is_available' => true,
                'description' => 'Furnished two-bedroom in Lekki Phase 1, a short walk from Admiralty Way. Inverter, fibre internet, and a manned estate gate. Comfortable for a week or a longer stay.',
            ],
            [
                'title' => 'Ikate 3-bedroom with a dedicated workspace',
                'area' => 'Lekki',
                'price_per_night' => 120000,
                'bedrooms' => 3,
                'is_available' => true,
                'description' => 'Three-bedroom flat in Ikate, set back from the expressway. One room is set up as a desk with a monitor. Prepaid meter, parking for one car, and 24-hour security.',
            ],
            [
                'title' => 'Chevron studio for short work trips',
                'area' => 'Lekki',
                'price_per_night' => 55000,
                'bedrooms' => 1,
                'is_available' => true,
                'description' => 'Compact one-bedroom in a serviced block off Chevron Drive. Queen bed, a small kitchen, and a balcony. Easy access to the Lekki-Epe Expressway.',
            ],
            [
                'title' => 'Phase 1 two-bedroom near the link bridge',
                'area' => 'Lekki',
                'price_per_night' => 78000,
                'bedrooms' => 2,
                'is_available' => false,
                'description' => 'Two-bedroom in a quiet close near the Lekki-Ikoyi Link Bridge. Gas cooker, washing machine, and estate water. Currently not taking new guests.',
            ],
            [
                'title' => 'Old Ikoyi one-bedroom with a lagoon balcony',
                'area' => 'Ikoyi',
                'price_per_night' => 175000,
                'bedrooms' => 1,
                'is_available' => true,
                'description' => 'High-floor one-bedroom in Old Ikoyi. King bed, a proper desk, and a balcony facing the lagoon. Generator backup and estate security overnight.',
            ],
            [
                'title' => 'Parkview two-bedroom terrace',
                'area' => 'Ikoyi',
                'price_per_night' => 210000,
                'bedrooms' => 2,
                'is_available' => true,
                'description' => 'Furnished terrace in Parkview Estate. Two bathrooms, a dining table for six, and parking inside the compound. A calm street, a few minutes from Awolowo Road.',
            ],
            [
                'title' => 'Banana Island 4-bedroom residence',
                'area' => 'Ikoyi',
                'price_per_night' => 450000,
                'bedrooms' => 4,
                'is_available' => true,
                'description' => 'Large furnished house on Banana Island for families or small groups. Private lounge, staff room, and generator backup. Minimum comforts are already in place for a longer booking.',
            ],
            [
                'title' => 'One-bedroom off Herbert Macaulay, Yaba',
                'area' => 'Yaba',
                'price_per_night' => 32000,
                'bedrooms' => 1,
                'is_available' => true,
                'description' => 'Tidy one-bedroom off Herbert Macaulay Way, often used by people visiting the Yaba tech corridor. Air conditioning, a workspace, and a kitchenette.',
            ],
            [
                'title' => 'Two-bedroom near Tejuosho Market',
                'area' => 'Yaba',
                'price_per_night' => 40000,
                'bedrooms' => 2,
                'is_available' => true,
                'description' => 'Two-bedroom on a residential street near Tejuosho. Fibre internet, a gas cooker, and running water. Straightforward drive onto the Third Mainland Bridge.',
            ],
            [
                'title' => 'Akoka 3-bedroom family flat',
                'area' => 'Yaba',
                'price_per_night' => 58000,
                'bedrooms' => 3,
                'is_available' => false,
                'description' => 'Three-bedroom flat in Akoka with a compound generator and parking. Close to the university and the Yaba mainland. Not available for new dates at the moment.',
            ],
            [
                'title' => 'Victoria Island duplex off Adeola Odeku',
                'area' => 'Victoria Island',
                'price_per_night' => 250000,
                'bedrooms' => 3,
                'is_available' => true,
                'description' => 'Furnished duplex off Adeola Odeku with a private lounge and a parking bay. Suited to guests working on Victoria Island who want a full kitchen rather than a hotel.',
            ],
            [
                'title' => 'Ozumba Mbadiwe one-bedroom',
                'area' => 'Victoria Island',
                'price_per_night' => 130000,
                'bedrooms' => 1,
                'is_available' => true,
                'description' => 'One-bedroom serviced apartment on Ozumba Mbadiwe. Elevator access, DSTV, and a desk by the window. Walking distance to offices along the VI waterfront.',
            ],
            [
                'title' => 'Ahmadu Bello Way two-bedroom',
                'area' => 'Victoria Island',
                'price_per_night' => 185000,
                'bedrooms' => 2,
                'is_available' => true,
                'description' => 'Two-bedroom in a managed block on Ahmadu Bello Way. Inverter, weekly cleaning on request, and secure basement parking. Quiet after office hours.',
            ],
            [
                'title' => 'Abraham Adesanya 3-bedroom, Ajah',
                'area' => 'Ajah',
                'price_per_night' => 70000,
                'bedrooms' => 3,
                'is_available' => true,
                'description' => 'Spacious three-bedroom inside Abraham Adesanya Estate. Prepaid meter, inverter, and a compound where children can be outside. Direct route to the Lekki-Epe Expressway.',
            ],
            [
                'title' => 'Sangotedo two-bedroom terrace',
                'area' => 'Ajah',
                'price_per_night' => 48000,
                'bedrooms' => 2,
                'is_available' => true,
                'description' => 'Two-bedroom terrace in a Sangotedo estate, past Ajah market. Fitted kitchen, one parking space, and estate security. A practical base if you do not need to be in Phase 1.',
            ],
            [
                'title' => 'Badore one-bedroom cottage',
                'area' => 'Ajah',
                'price_per_night' => 35000,
                'bedrooms' => 1,
                'is_available' => true,
                'description' => null, // Host has not written a description yet.
            ],
            [
                'title' => 'Surulere two-bedroom off Bode Thomas',
                'area' => 'Surulere',
                'price_per_night' => 45000,
                'bedrooms' => 2,
                'is_available' => true,
                'description' => 'Two-bedroom flat a few streets from Bode Thomas. Air conditioning in both rooms, a full kitchen, and street parking. A straightforward mainland stay.',
            ],
            [
                'title' => 'Adeniran Ogunsanya one-bedroom',
                'area' => 'Surulere',
                'price_per_night' => 30000,
                'bedrooms' => 1,
                'is_available' => true,
                'description' => 'One-bedroom above a shop street, set back enough to be quiet at night. Ceiling fans, a gas cooker, and reliable water. National Stadium is a short ride away.',
            ],
            [
                'title' => 'Ikeja GRA 3-bedroom bungalow',
                'area' => 'Ikeja',
                'price_per_night' => 110000,
                'bedrooms' => 3,
                'is_available' => false,
                'description' => 'Bungalow in Ikeja GRA with a small garden and parking for two cars. Generator for the living room and bedrooms. Booked out for the current season.',
            ],
            [
                'title' => 'Allen Avenue two-bedroom apartment',
                'area' => 'Ikeja',
                'price_per_night' => 80000,
                'bedrooms' => 2,
                'is_available' => true,
                'description' => 'Two-bedroom on a side street off Allen Avenue. Workspace in the living room, fibre internet, and a balcony. Convenient for the airport and the Ikeja business district.',
            ],
        ];

        foreach ($listings as $listing) {
            Property::query()->create($listing);
        }
    }
}
