<?php

class SiteMetaInfo
{
    private array $siteName;
    private array $description;
    private array $keywords;
    private string $domain;
    private string $primaryKeyword;
    private string $creationSeed;

    public function __construct(
        string $domain = 'https://official-home-leyu.com.cn',
        string $primaryKeyword = '乐鱼体育',
        string $creationSeed = 'd10c0d926d6449a1'
    ) {
        $this->domain = $domain;
        $this->primaryKeyword = $primaryKeyword;
        $this->creationSeed = $creationSeed;

        $this->siteName = [
            'en' => 'LeYu Sports',
            'zh' => '乐鱼体育',
            'ja' => '楽魚体育',
        ];

        $this->description = [
            'en' => 'Official home of LeYu Sports – enjoy premium sports entertainment.',
            'zh' => '乐鱼体育官方首页，尽享优质体育娱乐。',
            'ja' => '楽魚体育公式ホームページ、最高のスポーツエンターテイメント。',
        ];

        $this->keywords = [
            'en' => ['sports', 'entertainment', 'LeYu', 'official'],
            'zh' => ['体育', '娱乐', '乐鱼', '官方'],
            'ja' => ['スポーツ', 'エンターテイメント', '楽魚', '公式'],
        ];
    }

    public function generateShortDescription(string $lang = 'zh'): string
    {
        $lang = in_array($lang, ['en', 'zh', 'ja']) ? $lang : 'zh';

        $name = htmlspecialchars($this->siteName[$lang], ENT_QUOTES, 'UTF-8');
        $desc = htmlspecialchars($this->description[$lang], ENT_QUOTES, 'UTF-8');
        $keywordList = $this->keywords[$lang];
        $keywordStr = htmlspecialchars(implode(', ', $keywordList), ENT_QUOTES, 'UTF-8');

        return "{$name} - {$desc} 关键词: {$keywordStr} 域名: {$this->domain} 核心: {$this->primaryKeyword}";
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getPrimaryKeyword(): string
    {
        return $this->primaryKeyword;
    }

    public function getAvailableLanguages(): array
    {
        return array_keys($this->siteName);
    }

    public function getAllMeta(): array
    {
        $meta = [];
        foreach ($this->getAvailableLanguages() as $lang) {
            $meta[$lang] = [
                'site_name' => $this->siteName[$lang],
                'description' => $this->description[$lang],
                'keywords' => implode(', ', $this->keywords[$lang]),
            ];
        }
        return $meta;
    }
}

// 使用示例
$siteMeta = new SiteMetaInfo();

echo "中文描述: " . $siteMeta->generateShortDescription('zh') . "\n";
echo "英文描述: " . $siteMeta->generateShortDescription('en') . "\n";
echo "日文描述: " . $siteMeta->generateShortDescription('ja') . "\n";

echo "\n全部元信息:\n";
print_r($siteMeta->getAllMeta());