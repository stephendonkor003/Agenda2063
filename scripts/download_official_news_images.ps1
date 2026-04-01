$ErrorActionPreference = 'Stop'

$targetDir = Join-Path $PSScriptRoot '..\storage\app\public\news\banners\official'
$targetDir = [System.IO.Path]::GetFullPath($targetDir)

New-Item -ItemType Directory -Force -Path $targetDir | Out-Null

$downloads = @(
    @{
        FileName = 'africa-water-vision-2063-launch.jpg'
        Url = 'https://au.int/sites/default/files/styles/landing/public/pressreleases/46026-Press_Release_2_AWVP_TC.docxfin.jpg?itok=FGTX3mvy'
    },
    @{
        FileName = 'theme-of-the-year-2026-water.png'
        Url = 'https://au.int/sites/default/files/taxonomy/%20themes/Theme2026_Trending_English_2_copy.png'
    },
    @{
        FileName = 'au-media-fellowship-cohort-3.jpg'
        Url = 'https://au.int/sites/default/files/styles/landing/public/pressreleases/46136-82a2b749-61de-4f44-b223-700f7582f796.jpeg?itok=_IFV7x10'
    },
    @{
        FileName = 'second-africa-urban-forum-auf2.jpeg'
        Url = 'https://au.int/sites/default/files/styles/landing/public/newsevents/46115-960fcb3e-8ad1-4527-b715-c640fd09fb6f.jpeg?itok=1yKB_W8x'
    },
    @{
        FileName = 'tax-and-illicit-financial-flows-session.jpg'
        Url = 'https://au.int/sites/default/files/styles/landing/public/newsevents/46162-imgfifth_session_subcom_tax_iifs_poster.jpg?itok=F27UFtN0'
    },
    @{
        FileName = 'disarmament-non-proliferation-fellowship.jpeg'
        Url = 'https://au.int/sites/default/files/styles/landing/public/pressreleases/44787-whatsapp_image_2025-07-15_at_17.32.12.jpeg?itok=oA-O-dON'
    },
    @{
        FileName = 'au-germany-strategic-partnership.jpeg'
        Url = 'https://au.int/sites/default/files/styles/landing/public/pressreleases/45451-cca7456e-878e-4fcd-8e7c-6bbe86c9661a.jpeg?itok=R4WqzGNz'
    },
    @{
        FileName = 'humanitarian-mission-madagascar.jpeg'
        Url = 'https://au.int/sites/default/files/styles/landing/public/pressreleases/46135-ee5dc2bb-4b62-4bb6-9350-ae918d66c4d1.jpeg?itok=ay4CEH8S'
    }
)

$headers = @{
    'User-Agent' = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Agenda2063Seeder/1.0'
}

foreach ($item in $downloads) {
    $destination = Join-Path $targetDir $item.FileName
    Invoke-WebRequest -Uri $item.Url -Headers $headers -OutFile $destination -UseBasicParsing
}

Write-Output "Downloaded $($downloads.Count) official AU news images to $targetDir"
