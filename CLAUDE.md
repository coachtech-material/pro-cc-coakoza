# CourseHub

オンライン学習プラットフォーム。コーチがコースを作成し、受講生が学習・進捗管理できる。

## 技術スタック

- PHP 8.2 / Laravel 10
- MySQL 8.0
- Blade + Tailwind CSS
- Laravel Sail（Docker 開発環境）

## 開発環境

すべて Sail 経由で実行する（`./vendor/bin/sail`、エイリアス `sail` 推奨）。

```bash
# 起動
./vendor/bin/sail up -d

# マイグレーション + シーディング
./vendor/bin/sail artisan migrate --seed

# テスト
./vendor/bin/sail artisan test
```

- アプリ: http://localhost
- phpMyAdmin: http://localhost:8080

## コース構造

コンテンツは以下の階層で構成される。

```
Course（コース）
└─ Chapter（章 / order で整列）
   └─ Lesson（レッスン / body・is_published・order）
      └─ Quiz（小テスト / レッスンにつき 0〜1 / passing_score）
         └─ Question（設問 / order）
            └─ Option（選択肢 / is_correct）
```

- Course: `coach` が作成。category / tags / difficulty（beginner・intermediate・advanced）/ status（draft・published・archived）を持つ
- 受講生まわり: `Enrollment`（受講登録）, `LessonProgress`（レッスン進捗）, `Submission`（小テスト回答）
- 全公開レッスン完了時に `CourseCompleted` イベントが発火し、Enrollment が `completed` になる

## ユーザーロール

- admin: 管理者
- coach: コーチ（コース作成）
- student: 受講生

## コーディング規約・設計方針

`.claude/rules/coding.md` と README.md の「コーディング規約」「設計方針」セクションを参照。
