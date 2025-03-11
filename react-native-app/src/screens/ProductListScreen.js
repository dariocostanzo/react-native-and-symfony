import React, { useState, useEffect } from 'react';
import { View, Text, FlatList, StyleSheet, ActivityIndicator, RefreshControl, Platform } from 'react-native';
import ProductItem from '../components/ProductItem';

// Choose the appropriate API URL based on your environment
let API_URL;
if (Platform.OS === 'android') {
  // For Android emulator
  API_URL = 'http://10.0.2.2:8000';
} else if (Platform.OS === 'ios') {
  // For iOS simulator
  API_URL = 'http://localhost:8000';
} else {
  // For web testing
  API_URL = 'http://localhost:8000';
}

const ProductListScreen = () => {
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [refreshing, setRefreshing] = useState(false);
  const [error, setError] = useState(null);

  const fetchProducts = async () => {
    try {
      setLoading(true);
      setError(null);
      
      console.log(`Attempting to fetch from: ${API_URL}/api/products`);
      
      const response = await fetch(`${API_URL}/api/products`, {
        method: 'GET',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
      });
      
      if (!response.ok) {
        throw new Error(`Failed to fetch: ${response.status} ${response.statusText}`);
      }
      
      const text = await response.text();
      console.log('Raw response:', text);
      
      // Try to extract just the JSON part if there are HTML warnings
      let jsonText = text;
      const jsonStart = text.indexOf('[');
      if (jsonStart > 0) {
        jsonText = text.substring(jsonStart);
      }
      
      const data = JSON.parse(jsonText);
      console.log('Parsed data:', data);
      
      // Check if data is an array (direct products) or has a products property
      const productsList = Array.isArray(data) ? data : (data.products || []);
      setProducts(productsList);
    } catch (err) {
      setError(err.message);
      console.error('Error fetching products:', err);
    } finally {
      setLoading(false);
      setRefreshing(false);
    }
  };

  useEffect(() => {
    fetchProducts();
  }, []);

  const onRefresh = () => {
    setRefreshing(true);
    fetchProducts();
  };

  if (loading && !refreshing) {
    return (
      <View style={styles.centered}>
        <ActivityIndicator size="large" color="#0000ff" />
        <Text style={styles.loadingText}>Loading products...</Text>
      </View>
    );
  }

  if (error) {
    return (
      <View style={styles.centered}>
        <Text style={styles.errorText}>Error: {error}</Text>
        <Text style={styles.infoText}>
          Make sure your Symfony backend is running and accessible at {API_URL}
        </Text>
        <Text style={styles.infoText}>
          Check that the route /api/products exists and CORS is properly configured
        </Text>
      </View>
    );
  }

  return (
    <View style={styles.container}>
      <FlatList
        data={products}
        keyExtractor={(item) => item.id.toString()}
        renderItem={({ item }) => <ProductItem product={item} />}
        refreshControl={
          <RefreshControl refreshing={refreshing} onRefresh={onRefresh} />
        }
        ListEmptyComponent={
          <Text style={styles.emptyText}>No products found</Text>
        }
      />
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#f8f8f8',
  },
  centered: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 20,
  },
  loadingText: {
    marginTop: 10,
    fontSize: 16,
    color: '#333',
  },
  errorText: {
    fontSize: 16,
    color: 'red',
    marginBottom: 10,
  },
  infoText: {
    fontSize: 14,
    color: '#666',
    textAlign: 'center',
    marginBottom: 8,
  },
  emptyText: {
    textAlign: 'center',
    padding: 20,
    fontSize: 16,
    color: '#666',
  },
});

export default ProductListScreen;