<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Category;
use yii\data\Sort;

/**
 * CategorySearch represents the model behind the search form about `app\modules\admin\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'parent_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'alias'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Category::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->getId(),
            'status' => $this->getStatus(),
            'parent_id' => $this->getParentId(),
        ]);

        $query->andFilterWhere(['like', 'title', $this->getTitle()]);

        return $dataProvider;
    }
}
