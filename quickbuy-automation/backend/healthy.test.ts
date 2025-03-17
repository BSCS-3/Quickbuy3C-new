import axios from "axios";
import { describe, expect, test } from '@jest/globals';

const API_BASE_URL = "http://127.0.0.1:8000/api"; // Laravel API base URL
const api = axios.create({
    baseURL: API_BASE_URL,
    headers: { "Content-Type": "application/json" },
});

describe('Check API Endpoints Health', () => {
    test("GET admin /health should be healthy", async () => {
        expect.assertions(2);
        try {
            const response: any = await api.get('/health/admin')
            expect(response.status).toBe(200);
            expect(response.data).toMatchObject({"message": "working"});
        }catch(err){
            throw new Error(err.message);
        }
    });

    test("GET customer /health should return 200 and healthy message", async () => {
        expect.assertions(2);
        try {
            const response: any = await api.get('/health/customer')
            expect(response.status).toBe(200);
            expect(response.data).toMatchObject({"message": "working"});
        }catch(err){
            throw new Error(err.message);
        }
    });

    test("GET seller /health should return 200 and healthy message", async () => {
        expect.assertions(2);
        try {
            const response: any = await api.get('/health/seller')
            expect(response.status).toBe(200);
            expect(response.data).toMatchObject({"message": "working"});
        }catch(err){
            throw new Error(err.message);
        }
    });
})