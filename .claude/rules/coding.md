---
description: コーディング規約
globs: "app/**/*.php"
---

コードを生成・修正するときに従うルール。詳細は README.md の「コーディング規約」「設計方針」セクションを参照。

## 命名

- 変数名・メソッド名は camelCase、テーブル名・カラム名は snake_case
- Controller 名は単数形 + Controller（例: CourseController）

## 実装方針

- Controller のバリデーションは Form Request（`app/Http/Requests/` に配置）を使う
- Controller は薄く保ち、複数モデルにまたがる処理・複雑なロジックは `app/Services/` の Service クラスに切り出す
- リソースのアクセス制御は Policy で実装し、Controller で `$this->authorize()` を呼ぶ（Policy は `AuthServiceProvider` に登録する）
- モデルのリレーションは明示的に定義する
- 重要なドメインイベントは Event/Listener パターンで実装する

## Blade 画面のエラー処理

- エラーはリダイレクトで返し、処理結果はフラッシュメッセージで通知する

## テスト

- 新機能には Feature テストを書く。テストメソッド名は `test_` プレフィックス

## 既存コードとの乖離

現行コードには未対応箇所があるが、**新規・改修コードでは上記ルールに従う**（既存実装をコピーしない）。

- `$request->validate()` を Controller に直接書いた箇所が混在（Form Request 未統一）
- 肥大化した Controller（例: `CoachCourseController::store`）
