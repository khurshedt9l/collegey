<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\College;

/**
 * CollegeSearch represents the model behind the search form about `common\models\College`.
 */
class CollegeSearch extends College
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'university_id', 'statutory_body_id', 'important_links_id', 'download_links_id', 'is_featured', 'status', 'college_image_id'], 'integer'],
            [['name', 'description', 'website', 'logo', 'banner', 'establish', 'created', 'modified'], 'safe'],
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
        $query = College::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'university_id' => $this->university_id,
            'establish' => $this->establish,
            'statutory_body_id' => $this->statutory_body_id,
            'important_links_id' => $this->important_links_id,
            'download_links_id' => $this->download_links_id,
            'is_featured' => $this->is_featured,
            'created' => $this->created,
            'modified' => $this->modified,
            'status' => $this->status,
            'college_image_id' => $this->college_image_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'banner', $this->banner]);

        return $dataProvider;
    }
}
