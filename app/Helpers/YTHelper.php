<?php
namespace App\Helpers;

class YTHelper
{
public static function extractVideoId($url)
    {
     $pattern = '/(?:youtube(?:-nocookie)?\.com(?:\/(?:watch\?v=|embed\/|v\/|shorts\/)|\/.*[?&]v=)|youtu\.be\/)([A-Za-z0-9_-]{11})/';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
  public static function getVideoDuration($videoId)
    {
        try {
            $url = "https://www.youtube.com/watch?v={$videoId}";
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'Accept-Language' => 'en-US,en;q=0.9',
            ])->get($url);

            if ($response->failed()) {
                return null;
            }

            $html = $response->body();

            // Try to extract from primary "lengthSeconds"
            if (preg_match('/"lengthSeconds":"(\d+)"/', $html, $matches)) {
                return self::formatDuration((int)$matches[1]);
            }

            // Backup pattern: extract from JSON like "approxDurationMs":"272000"
            if (preg_match('/"approxDurationMs":"(\d+)"/', $html, $matches)) {
                $seconds = floor(((int)$matches[1]) / 1000);
                return self::formatDuration($seconds);
            }

            // Shorts pages sometimes use a different format
            if (preg_match('/"videoDetails":\{"videoId":"'.$videoId.'".*?"lengthSeconds":"(\d+)"/s', $html, $matches)) {
                return self::formatDuration((int)$matches[1]);
            }
        } catch (\Throwable $e) {
            // Optional: log error
        }

        return null;
    }

    protected static function formatDuration($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $secs = $seconds % 60;

        if ($hours > 0) {
            return sprintf('%d:%02d:%02d', $hours, $minutes, $secs);
        }
        return sprintf('%d:%02d', $minutes, $secs);
    }
}
